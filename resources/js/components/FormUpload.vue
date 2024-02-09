<template>
    <div class="de-form__upload">
        <div class="de-form__upload--avatar">
            <img v-if="preview" :src="preview" />
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
import { PropType, ref, watch } from 'vue';

export default {
    name: 'FormUpload',
    emits: ['update:model-value'],
    props: {
        modelValue: null as unknown as PropType<String | Object>,
        preview: null as unknown as PropType<String | null>,
        title: { type: String, default: "Upload Image" },
        isRequired: { type: Boolean, default: false },
        error: { type: String, default: null },
    },
    setup(props, { emit }) {
        const preview = ref<String | null>(null);
        const onChange = (e: any) => {
            const image = e.target.files[0];
            emit('update:model-value', image);
            preview.value = URL.createObjectURL(image);
        }

        if (props.preview) preview.value = props.preview;
        return { preview, onChange }
    }
}
</script>
