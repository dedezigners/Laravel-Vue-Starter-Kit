<template>
    <div class="de-form__upload">
        <div class="de-form__upload--avatar">
            <img v-if="previewImage" :src="previewImage ?? ''" />
            <font-awesome-icon v-else icon="image" />
        </div>
        <div class="de-form__upload--content">
            <h6>{{ title }}{{ isRequired ? ' *' : '' }}</h6>
            <span>Choose an image</span>
        </div>
        <label class="btn btn-sm btn-secondary">
            <span>Upload Image</span>
            <input type="file" @change="onChange" style="display: none;"/>
        </label>
    </div>
    <div class="de-form__message">
        <div class="alert alert-danger py-2" v-if="error">{{ error }}</div>
    </div>
</template>

<script lang="ts">
import axios from 'axios';
import { PropType, ref, watch } from 'vue';

export default {
    name: 'FormUpload',
    emits: ['update:model-value'],
    props: {
        modelValue: null as unknown as PropType<String | Object>,
        preview: String,
        type: String,
        filename: String,
        title: { type: String, default: "Upload Image" },
        isRequired: { type: Boolean, default: false },
        error: { type: String, default: null },
    },
    setup: (props, { emit }) => {
        const previewImage = ref<String | null>(null);
        const onChange = (e: any) => {
            const image = e.target.files[0];
            previewImage.value = URL.createObjectURL(image);
            
            if (props.type && props.filename) {
                axios.post(`/upload-image`, {
                    image: image,
                    type: props.type,
                    filename: props.filename,
                }, {
                    headers: {
                        "Content-Type": "multipart/form-data",
                    }
                }).then(res => {
                    emit('update:model-value', res.data);
                }).catch(e => console.error(e));
            } else emit('update:model-value', image);
        }

        if (props.preview) previewImage.value = props.preview;
        return {
            previewImage,
            onChange
        }
    }
}
</script>
