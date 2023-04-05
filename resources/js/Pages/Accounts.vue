<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, usePage } from '@inertiajs/vue3';


const propsDefinition = defineProps({
    users: {
        type: Object,
        required: true
    },
});
console.log(propsDefinition.users);

</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout v-if="usePage().props.auth.user.admin_level > 5">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Accounts</h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <p class="h2 mt-7">All accounts</p>
                            <div>
                                <ul class="list-group" v-for="(n, index) in users" v-bind:key="index">
                                    <li class="list-group-item">
                                        <a class="py-4" :href="route('users.showData', { id: n.id })" target="_blank">(ID: {{ n.id }}) Name: {{ n.name }} - Email: {{ n.email }} - Admin: {{ n.admin_level > 0 ? n.admin_level : 'No level set'}}</a>
                                    </li>
                                </ul>
                            </div>

                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
