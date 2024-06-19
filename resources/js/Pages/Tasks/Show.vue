<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head,Link } from "@inertiajs/vue3";

const props = defineProps({
    task: {
        type: Object
    }
});

</script>

<template>

    <Head title="Update Task" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Task: {{ task.title }}
            </h2>
        </template>

        <div
            class="my-3 max-w-7xl sm:mx-auto sm:px-6 lg:px-8 space-y-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 p-6">

                        <p>
                            Title:{{ task.title }}
                        </p>
                        <p>
                            Due Date:{{ task.duedate }}
                        </p>
                        <p>
                            Status:{{ task.status }}
                        </p>
                        <div class="colspan-2">
                            Description:{{ task.description }}
                        </div>
                        <div class="flex items-center gap-4">

                            <Link
                                :href="route('tasks.index')"
                                class="inline-block rounded-md border border-gray-300 px-4 py-3 text-xs font-semibold uppercase tracking-widest shadow-sm"
                            >
                                Back
                            </Link>
                        </div>

            </div>
        </div>
        </div>
    </AuthenticatedLayout>
</template>
