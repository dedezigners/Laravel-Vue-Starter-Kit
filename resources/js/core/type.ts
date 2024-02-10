export interface MenuItem {
    name: string,
    route: string,
    icon?: string,
    is_active: boolean,
    children?: MenuItem[],
}

export interface Menu {
    heading?: string,
    prefix: string,
    is_active: boolean,
    pages: MenuItem[],
}

export interface AuthUser {
    image: string | null,
    name: string,
    user: string,
    is_admin: boolean,
    role: string,
}

export interface DeTableHead {
    label: string,
    name: string,
    sort: boolean,
    class?: string,
}

export interface Resource<T> {
    data: T,
}

export interface BlogCategory {
    id: number,
    icon?: string,
    name?: string,
    slug?: string,
    parent?: number | null,
    desc?: string | null,
    created_at?: string,
}

export interface BlogTag {
    id: number,
    name?: string,
    slug?: string,
    desc?: string | null,
    created_at?: string,
}

export interface Post {
    id?: number | null,
    image?: string | object,
    thumb?: string,
    title?: string | null,
    slug?: string,
    category_id?: any,
    tag_ids?: [],
    excerpt?: string | null,
    content?: string,
}

export interface User {
    id?: number,
    image?: string | object,
    p_image?: string,
    thumb?: string,
    name?: string,
    email?: string,
    username?: string,
    password?: string,
    role?: string,
    location?: string,
    phone?: string,
}
