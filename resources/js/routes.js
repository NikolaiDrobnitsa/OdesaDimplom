import Home from './components/Home'
import Categories from "./screens/admin/category/categories"
import addCategory from "./screens/admin/category/addCategory";
import editCategory from "./screens/admin/category/editCategory";
import addProduct from "./screens/admin/product/addProduct";
import products from "./screens/admin/product/products"
import editProduct from "./screens/admin/product/editProduct";
import HomePage from "./screens/client/HomePage";
import Login from "./screens/auth/Login";
import Shop from "./screens/client/shop/Shop";
import ProductDetails from "./screens/client/shop/ProductDetails";
import CategoryProducts from "./screens/client/shop/CategoryProducts";
import Bookings from "./screens/admin/booking/bookings"
import addBooking from "./screens/admin/booking/addBooking"
import editBooking from "./screens/admin/booking/editBooking"

export default {
    mode:'history',
    routes: [
        {
            path:'/',
            component: Home
        },
        {
            path:'/admin/categories',
            component: Categories
        },
        {
            path:'/admin/addCategory',
            component: addCategory
        },
        {
            path:'/admin/editCategory',
            component: editCategory,
            props: true,
            name: 'editCategory'
        },
        {
            path:'/admin/addProduct',
            component: addProduct
        },
        {
            path:'/admin/products',
            component: products
        },
        {
            path:'/admin/editProduct',
            component: editProduct,
            props: true,
            name: 'editProduct'
        },
        {
            path:'/admin/bookings',
            component: Bookings
        },

        {
            path: '/home',
            component: HomePage
        },
        {
            path: '/login',
            component: Login,
            name: 'Login'
        },
        {
            path: '/shop',
            component: Shop,
            name: 'Shop'
        },
        {
            path: '/shop/productDetails',
            component: ProductDetails,
            props: true,
            name: 'ProductDetails'
        },
        {
            path: '/shop/categoryProducts',
            component: CategoryProducts,
            props: true,
            name: 'CategoryProducts'
        },
        {
            path:'/admin/addBooking',
            component: addBooking
        },
        {
            path:'/admin/editBooking',
            component: editBooking,
            props: true,
            name: 'editBooking'
        },

    ]
}
