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
