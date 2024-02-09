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
        heading: "User",
        prefix: '/admin',
        is_active: false,
        pages: [
            {
                name: "Users",
                route: '/users',
                icon: 'user-group',
                is_active: false,
            },
            {
                name: "Roles",
                route: '/users',
                icon: 'user-gear',
                is_active: false,
            },
            {
                name: "Permissions",
                route: '/users',
                icon: 'user-lock',
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
            {
                name: "Posts",
                route: '/posts',
                icon: 'newspaper',
                is_active: false,
            },
        ]
    }
];

export default menu;
