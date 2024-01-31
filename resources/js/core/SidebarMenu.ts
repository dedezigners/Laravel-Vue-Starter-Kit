import { Menu } from "./type";

const menu: Menu[] = [
    {
        prefix: '/admin',
        is_active: false,
        pages: [
            {
                name: "Dashboard",
                route: '/dashboard',
                icon: 'house',
                is_active: false,
            }
        ]
    },
    {
        heading: "Shop",
        prefix: '/admin/shop',
        is_active: false,
        pages: [
            {
                name: "Products",
                route: '/posts',
                icon: 'dolly',
                is_active: false,
                children: [
                    {
                        name: "All Products",
                        route: '/products',
                        is_active: false,
                    },
                    {
                        name: "Trashed Products",
                        route: '/trashed-products',
                        is_active: false,
                    },
                ]
            },
            {
                name: "Categories",
                route: '/categories',
                icon: 'layer-group',
                is_active: false,
            },
            {
                name: "Orders",
                route: '/orders',
                icon: 'cart-shopping',
                is_active: false,
            },
        ]
    },
    {
        heading: "Blog",
        prefix: '/admin/blog',
        is_active: false,
        pages: [
            {
                name: "Posts",
                route: '/posts',
                icon: 'newspaper',
                is_active: false,
            },
            {
                name: "Categories",
                route: '/categories',
                icon: 'layer-group',
                is_active: false,
            },
            {
                name: "Tags",
                route: '/tags',
                icon: 'tags',
                is_active: false,
            },
        ]
    }
];

export default menu;
