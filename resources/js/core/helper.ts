import { Modal } from "bootstrap";

export const slugigy = (str: String) => {
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