import { Modal } from "bootstrap";

export const slugify = (str: string): string => {
    return String(str)
        .normalize('NFKD')
        .replace(/[\u0300-\u036f]/g, '')
        .trim()
        .toLowerCase()
        .replace(/[^a-z0-9 -]/g, '')
        .replace(/\s+/g, '-')
        .replace(/-+/g, '-');
}

export const hideModal = (modalEl: HTMLElement | null): void => {
    if (!modalEl) {
        return;
    }

    const myModal = Modal.getInstance(modalEl);
    myModal?.hide();
};

export const clearForm = (form: Object): Object => {
    let nForm: any = { ...form };
    const formkeys = Object.keys(form);
    formkeys.forEach(k => nForm[k] = null);

    return nForm;
}

export const hideTooltip = (e: MouseEvent): void => {
    const elem = e.currentTarget!;
    // @ts-ignore
    let tooltipKey: string = elem.getAttribute('aria-describedby');
    const tooltipElem = document.getElementById(tooltipKey);
    tooltipElem?.remove();
  }
