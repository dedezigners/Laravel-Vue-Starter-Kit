export interface MenuItem {
    name: string,
    route: string,
    icon?: string,
    children?: MenuItem[],
}

export interface Menu {
    heading?: string,
    prefix?: string,
    pages: MenuItem[],
}
