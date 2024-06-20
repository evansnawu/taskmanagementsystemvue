<script setup>
import MagnifyingGlass from "@/Components/Icons/MagnifyingGlass.vue";
import Pagination from "@/Components/Pagination.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, router, useForm, usePage } from "@inertiajs/vue3";
import { ref, inject, watch, computed } from "vue";

const swal = inject('$swal');

defineProps({
    tasks: {
        type: Object,
    },
});

let pageNumber = ref(1),
    searchTerm = ref(usePage().props.search ?? ""),
    noPerPage = ref(usePage().props.noperpage ?? ""),
    orderColumn = ref(usePage().props.ordercolumn ?? ""),
    orderDirection = ref(usePage().props.orderdirection ?? "");


const pageNumberUpdated = (link) => {
    pageNumber.value = link.url.split("=")[1];
};

let tasksUrl = computed(() => {
    const url = new URL(route("tasks.index"));

    url.searchParams.set("page", pageNumber.value);

    if (searchTerm.value) {
        url.searchParams.set("search", searchTerm.value);
    }

    if (orderColumn.value) {
        url.searchParams.set("ordercolumn", orderColumn.value);
    }

    if (orderDirection.value) {
        url.searchParams.set("orderdirection", orderDirection.value);
    }

    if (noPerPage.value) {
        url.searchParams.set("noperpage", noPerPage.value);
    }

    return url;
});

const noPerPageChanged = (event) => {
    noPerPage.value = event.target.value;
}

const sortChanged = (name) => {

    if (name === orderColumn.value) {
        if (orderDirection.value === "asc") {
            orderDirection.value = "desc";
        } else {
            orderDirection.value = "asc";
        }
    } else {
        orderColumn.value = name;
        orderDirection.value = "asc";
    }

};

watch(
    () => tasksUrl.value,
    (newValue) => {
        router.visit(newValue, {
            replace: true,
            preserveState: true,
            preserveScroll: true,
        });
    }
);

const deleteForm = useForm({});

const deleteTask = (id) => {
    swal.fire({
        title: 'Are you sure?',
        text: "You want to delete this line!",
        icon: 'warning',
        confirmButtonClass: 'btn btn-danger mr-2',
        cancelButtonClass: 'btn btn-dark mr-2',
        denyButtonClass: 'btn btn-success mr-2',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            deleteForm.delete(route("tasks.destroy", id), {
                preserveScroll: true,
            });
        }
    })
}

</script>

<template>

    <Head title="Tasks" />

    <AuthenticatedLayout>

        <div class="bg-gray-100 py-10">
            <div class="mx-auto max-w-7xl">
                <div class="px-4 sm:px-6 lg:px-8">
                    <div class="sm:flex sm:items-center">
                        <div class="sm:flex-auto">
                            <h1 class="text-xl font-semibold text-gray-900">
                                Tasks
                            </h1>
                            <p class="mt-2 text-sm text-gray-700">
                                A list of all the Tasks.
                            </p>
                        </div>

                        <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                            <Link :href="route('tasks.create')"
                                class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto">
                            Add Task
                            </Link>
                        </div>
                    </div>
                    <div class="flex flex-col justify-between sm:flex-row mt-6">
                        <div class="relative text-sm text-gray-800 col-span-3">
                            <div
                                class="absolute pl-2 left-0 top-0 bottom-0 flex items-center pointer-events-none text-gray-500">
                                <MagnifyingGlass />
                            </div>

                            <input type="text" v-model="searchTerm" placeholder="Search tasks data..." id="search"
                                class="block rounded-lg border-0 py-2 pl-10 text-gray-900 ring-1 ring-inset ring-gray-200 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                        </div>

                        <select @change="noPerPageChanged($event)"
                            class="block rounded-lg border-0 py-2 pl-10 text-gray-900 ring-1 ring-inset ring-gray-200 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            <option :value="null">Show Entries</option>
                            <option value="5">5 per page</option>
                            <option value="10">10 per page</option>
                            <option value="20">20 per page </option>
                            <option value="30">30 per page</option>
                            <option value="50">50 per page</option>
                        </select>


                    </div>

                    <div class="mt-8 flex flex-col">
                        <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                                <div
                                    class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg relative">
                                    <table class="min-w-full divide-y divide-gray-300">
                                        <thead class="bg-gray-50">
                                            <tr>

                                                <th scope="col"
                                                    class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                                    <div class="flex flex-row items-center justify-between cursor-pointer"
                                                        @click="sortChanged('title')">
                                                        <div class="leading-4 font-medium text-gray-700  tracking-wider"
                                                            :class="{ 'font-bold text-blue-600': orderColumn === 'title' }">
                                                            Title
                                                        </div>
                                                        <div class="select-none">
                                                            <span :class="{
                                                                'text-blue-600': orderDirection === 'asc' && orderColumn === 'title',
                                                                'hidden': orderDirection !== '' && orderDirection !== 'asc' && orderColumn === 'title',
                                                            }">&uarr;</span>
                                                            <span :class="{
                                                                'text-blue-600': orderDirection === 'desc' && orderColumn === 'title',
                                                                'hidden': orderDirection !== '' && orderDirection !== 'desc' && orderColumn === 'title',
                                                            }">&darr;</span>
                                                        </div>
                                                    </div>
                                                </th>
                                                <th scope="col"
                                                    class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-700 sm:pl-6">
                                                    Description
                                                </th>
                                                <th scope="col"
                                                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                                    <div class="flex flex-row items-center justify-between cursor-pointer"
                                                        @click="sortChanged('duedate')">
                                                        <div class="leading-4 font-medium text-gray-500  tracking-wider"
                                                            :class="{ 'font-bold text-blue-600': orderColumn === 'duedate' }">
                                                            Due Date
                                                        </div>
                                                        <div class="select-none">
                                                            <span :class="{
                                                                'text-blue-600': orderDirection === 'asc' && orderColumn === 'duedate',
                                                                'hidden': orderDirection !== '' && orderDirection !== 'asc' && orderColumn === 'duedate',
                                                            }">&uarr;</span>
                                                            <span :class="{
                                                                'text-blue-600': orderDirection === 'desc' && orderColumn === 'duedate',
                                                                'hidden': orderDirection !== '' && orderDirection !== 'desc' && orderColumn === 'duedate',
                                                            }">&darr;</span>
                                                        </div>
                                                    </div>
                                                </th>
                                                <th scope="col"
                                                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-700">
                                                    Status
                                                </th>
                                                <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6" />
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-200 bg-white">
                                            <tr v-for="task in tasks.data" :key="task.id">
                                   
                                                <td
                                                    class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-500 sm:pl-6">
                                                    {{ task.title }}
                                                </td>
                                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                    {{ task.description }}
                                                </td>
                                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                    {{ task.duedate }}
                                                </td>
                                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 ">
                                                    <span class="rounded px-2 py-1 text-white"
                                                    :class="{'bg-green-500 ':task.status=='Completed',
                                                    'bg-gray-500 ':task.status=='Pending',
                                                    'bg-orange-500 ':task.status=='In Progress',
                                                }">{{ task.status }}</span>

                                                </td>

                                                <td
                                                    class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                                    <Link :href="route(
                                                        'tasks.edit',
                                                        task.id
                                                    )
                                                        " class="text-indigo-600 hover:text-indigo-900">
                                                    Edit
                                                    </Link>
                                                    <button @click="
                                                        deleteTask(
                                                            task.id
                                                        )
                                                        " class="ml-2 text-indigo-600 hover:text-indigo-900">
                                                        Delete
                                                    </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <Pagination :data="tasks" :pageNumberUpdated="pageNumberUpdated" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
