import { Menu } from "./type";

const menu: Menu[] = [
    {
        prefix: '/admin',
        pages: [
            {
                name: "Dashboard",
                route: '/dashboard',
                icon: 'house'
            }
        ]
    },
    {
        heading: "Shop",
        prefix: '/admin/shop',
        pages: [
            {
                name: "Products",
                route: '/posts',
                icon: 'dolly',
                children: [
                    {
                        name: "All Products",
                        route: '/products'
                    },
                    {
                        name: "Trashed Products",
                        route: '/trashed-products'
                    },
                ]
            },
            {
                name: "Categories",
                route: '/categories',
                icon: 'layer-group'
            },
            {
                name: "Orders",
                route: '/orders',
                icon: 'cart-shopping'
            },
        ]
    },
    {
        heading: "Blog",
        prefix: '/admin/blog',
        pages: [
            {
                name: "Posts",
                route: '/posts',
                icon: 'newspaper'
            },
            {
                name: "Categories",
                route: '/categories',
                icon: 'layer-group'
            },
            {
                name: "Tags",
                route: '/tags',
                icon: 'tags'
            },
        ]
    }
];

export default menu;
