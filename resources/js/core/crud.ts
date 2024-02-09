import axios from "axios";
import { ref } from "vue";
import { ElMessageBox } from "element-plus";
import { hideModal } from "./helper";

export const useCrud = (endPoint: string, activeData: any, trashedData: any) => {
    // Datatable
    const modalButtonRef = ref<HTMLElement | null>(null);
    const showTrashed = ref(false);
    const editData = ref<any | null>(null);

    // Modal
    const modalRef = ref<HTMLElement | null>(null);
    const loading = ref(false);
    const errors = ref<any>([]);
    
    const onEditSelect = (id: number) => {
        const data = activeData.find((c: { id: number }) => c.id === id);
        modalButtonRef.value?.click();
        editData.value = data;
    }

    const onDelete = (id: number) => {
        ElMessageBox.confirm(
            'Are you sure! you want to delete this item?',
            'Confirm delete?',
            {
                type: 'warning',
                confirmButtonText: 'Yes Delete',
                confirmButtonClass: 'btn btn-danger',
                cancelButtonClass: 'btn btn-secondary',
                cancelButtonText: 'Cancel',
            }
        ).then(() => {
            const rowIndex = activeData.findIndex((c: { id: number }) => c.id === id);
            axios.delete(`${endPoint}/${id}`);

            trashedData.push(activeData[rowIndex]);
            activeData.splice(rowIndex, 1);
        }).catch(() => {});
    }

    const onRestore = (id: number) => {
        const rowIndex = trashedData.findIndex((c: { id: number }) => c.id === id);
        axios.put(`${endPoint}/${id}/restore`);

        activeData.unshift(trashedData[rowIndex]);
        trashedData.splice(rowIndex, 1);
    }

    const onPermanent = (id: number) => {
        ElMessageBox.confirm(
            'Are you sure! you want to delete this item, this cannot be undo?',
            'Confirm delete?',
            {
                type: 'warning',
                confirmButtonText: 'Yes Delete',
                confirmButtonClass: 'btn btn-danger',
                cancelButtonClass: 'btn btn-secondary',
                cancelButtonText: 'Cancel',
            }
        ).then(() => {
            const rowIndex = trashedData.findIndex( (c: {id: number}) => c.id === id);
            axios.delete(`${endPoint}/${id}/permanent`);

            trashedData.splice(rowIndex, 1);
        }).catch(() => {});
    }

    // Modal
    const closeModal = () => {
        editData.value = null;
        loading.value = false;
        errors.value = [];
        hideModal(modalRef.value);
    }

    const onSubmit = async (formData: any, isEdit: false) => {
        try {
            let res = null;
            loading.value = true;
            errors.value = [];

            res = isEdit ?
            await axios.put(`${endPoint}/${editData.value?.id}`, formData) :
            await axios.post(`${endPoint}`, formData);
            // console.log(res.data.data);

            if (isEdit) {
                const rowIndex = activeData.findIndex((c: { id: number }) => c.id === editData.value?.id);
                activeData.splice(rowIndex, 1);
                activeData.unshift(res.data.data);
            } else activeData.unshift(res.data.data);
            closeModal();
            return true;
            
        } catch (error: any) {
            console.error(error.message);
            console.error(error.response.data);
            errors.value = error.response.data.errors ?? [];
            loading.value = false;

            return false;
        }
    }

    const setModalRef = (ref: HTMLElement | null) => modalRef.value = ref;

    return {
        loading,
        errors,
        activeData,
        trashedData,
        modalButtonRef,
        showTrashed,
        editData,
        closeModal,
        onSubmit,
        setModalRef,
        onEditSelect,
        onDelete,
        onRestore,
        onPermanent,
    }
}