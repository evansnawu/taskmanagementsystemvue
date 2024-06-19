<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import SelectInput from "@/Components/SelectInput.vue";

const props = defineProps({
    status: {
        type: Array,
    },
    task: {
    type: Object
  }
});

const form = useForm({
    title: props.task.title,
    duedate: props.task.duedate,
    status: props.task.status,
    description: props.task.description,
});

</script>

<template>
    <Head title="Update Task" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Update Task
            </h2>
        </template>

        <div
            class="my-3 max-w-7xl sm:mx-auto sm:px-6 lg:px-8 space-y-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 py-12"
        >
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                    <div>
                        <h3
                            class="text-lg leading-6 font-medium text-gray-900  pl-6"
                        >
                            Task Information
                        </h3>
                        <p class="mt-1 text-sm text-gray-500  pl-6">
                            Use this form to edit a new task.
                        </p>
                    </div>

                    <form @submit.prevent="form.put(route('tasks.update', props.task))" class="grid grid-cols-1 lg:grid-cols-2 gap-4 p-6">
                        <div class="mb-4">
                            <InputLabel for="title" value="Title" />

                            <TextInput
                                id="title"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.title"
                                required
                                autofocus
                                autocomplete="title"
                            />

                            <InputError
                                class="mt-2"
                                :message="form.errors.title"
                            />
                        </div>

                        <div class="mb-4">
                            <InputLabel for="duedate" value="Due Date" />

                            <TextInput
                                id="duedate"
                                type="date"
                                class="mt-1 block w-full"
                                v-model="form.duedate"
                                required
                                autofocus
                                autocomplete="duedate"
                            />

                            <InputError
                                class="mt-2"
                                :message="form.errors.duedate"
                            />
                        </div>

                        <div class="mb-4">
                            <InputLabel for="status" value="Status" />
                            <SelectInput
                              class="mt-1 block w-full"
                                v-model="form.status"
                                :options="status"
                                option-value="id"
                                option-label="name"
                                :default-option="{
                                    id: '',
                                    name: 'Please select',
                                }"
                            />

                            <InputError
                            class="mt-2"
                            :message="form.errors.status"
                        />
                        </div>

                        <div class="mb-4">
                            <InputLabel for="description" value="Description" />
                            <textarea
                                v-model="form.description"
                                id="description"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            ></textarea>

                            <InputError
                            class="mt-2"
                            :message="form.errors.description"
                        />
                        </div>

                        <div class="flex items-center gap-4">
                            <PrimaryButton :processing="form.processing" >Update Task</PrimaryButton>
                            <Link
                                :href="route('tasks.index')"
                                class="inline-flex items-center justify-center rounded-md border border-gray-300  bg-white px-4 py-2 text-sm font-medium  shadow-sm hover:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto"
                            >
                                Cancel
                            </Link>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
