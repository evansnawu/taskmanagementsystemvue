<template></template>
<script setup>
import { onMounted, onUpdated,inject } from 'vue';

const swal = inject('$swal');
const props = defineProps({
    status: {
        type: Object,
        default: {}
    },
});

function showSwal() {
    swal.fire(
        props.status.action,
        props.status.text,
        props.status.type
    )
}

onMounted(() => {
    if (props.status) {
        showSwal()
    }
})

onUpdated(() => {
    if (props.status) {
        showSwal()
    }
})
</script>
