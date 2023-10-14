<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Product;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with('product', 'product.category')->get();


//        foreach ($bookings as $booking) {
//            $booking->productName = $booking->product->name; // Добавить название продукта в каждое бронирование
//        }
//        return response()->json($bookings);
        return response()->json([
            'bookings' => $bookings
        ]);
    }
    public function booking($productId)
    {
        $bookings = Booking::where('product_id', $productId)->get();
        return response()->json($bookings);
    }

    public function store(Request $request)
    {
        // Валидация запроса
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'booking_dates' => 'required|array',
            'booking_dates.*' => 'required|date|distinct',
            'client_name' => 'required|string|max:255',
            'client_phone' => 'required|string|max:255',
            'client_email' => 'required|email|max:255',
            'arrival_time' => 'required|date_format:H:i',
            'special_requests' => 'nullable|string',
        ]);

        // Проверьте, не заняты ли уже эти даты
        $isBooked = Booking::where('product_id', $request->product_id)
            ->whereIn('booking_date', $request->booking_dates)
            ->exists();

        if ($isBooked) {
            return response()->json(['message' => 'Вибрана дата можливо вже заброьована'], 422);
        }

        // Создайте новые записи бронирования
        foreach ($request->booking_dates as $date) {
            $booking = new Booking();
            $booking->product_id = $request->product_id;
            $booking->booking_date = $date;
            $booking->client_name = $request->client_name;
            $booking->client_phone = $request->client_phone;
            $booking->client_email = $request->client_email;
            $booking->arrival_time = $request->arrival_time;
            $booking->special_requests = $request->special_requests;
            $booking->save();
        }

        return response()->json(['message' => 'Успішне бронювання']);
    }
    public function update(Request $request, $bookingId)
    {
        // Валидация запроса
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'booking_dates' => 'required|array',
            'booking_dates.*' => 'required|date|distinct',
            'client_name' => 'required|string|max:255',
            'client_phone' => 'required|string|max:255',
            'client_email' => 'required|email|max:255',
            'arrival_time' => 'required|date_format:H:i',
            'special_requests' => 'nullable|string',
        ]);


        // Проверьте, не заняты ли уже эти даты
        $isBooked = Booking::where('product_id', $request->product_id)
            ->where('id', '!=', $bookingId) // исключаем текущее бронирование из проверки
            ->whereIn('booking_date', $request->booking_dates)
            ->exists();

        if ($isBooked) {
            return response()->json(['message' => 'Вибрана дата можливо вже заброьована'], 422);
        }

        // Найдите и обновите запись бронирования
        $booking = Booking::find($bookingId);

        if (!$booking) {
            return response()->json(['message' => 'Бронювання не знайдено'], 404);
        }


        try {
            $booking->update([
                'product_id' => $request->product_id,
                'booking_date' => $request->booking_dates[0],
                'client_name' => $request->client_name,
                'client_phone' => $request->client_phone,
                'client_email' => $request->client_email,
                'arrival_time' => $request->arrival_time,
                'special_requests' => $request->special_requests,
            ]);
        } catch (\Exception $e) {
            // Здесь можно логировать ошибку
            //\Log::error('Error updating booking: '.$e->getMessage());
            return response()->json(['message' => 'Помилка оновлення зображення'], 500);
        }
        // Обновление дат бронирования может быть сложным, в зависимости от вашей бизнес-логики.
        // Возможно, вам придется удалить старые даты и добавить новые, либо изменить существующие.

        return response()->json(['message' => 'Бронювання успішно оновилося']);
    }
//    public function search(Request $request)
//    {
//        // Получите поисковый запрос из клиента
//        $query = $request->input('query');
//
//        // Выполните поиск на сервере, используя $query для фильтрации данных
//        $bookings = Booking::where('client_name', 'LIKE', "%$query%")
//            ->with('product', 'product.category')
//            ->get();
//
//        return response()->json(['bookings' => $bookings]);
//    }
    public function destroy(string $id)
    {
        $product = Booking::findOrFail($id);
        $product->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Бронювання успішно видаленно!'
        ]);
    }

}
