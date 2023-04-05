<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, usePage, useForm } from '@inertiajs/vue3';

const form = useForm({});
const propsDefinition = defineProps({
    links_: {
        type: Object,
        required: true
    },
});
console.log(propsDefinition.links_);

function openLink(link) {
    window.open(link, '_blank');
}

</script>

<template>
    <Head title="Dashboard" />

<AuthenticatedLayout>
    <template #header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Links</h2>
    </template>
    <!-- <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                            <p class="h2 mt-7">Links - {{ links_.length }}</p>

                            <div>
                                    <ul class="list-group" v-for="(n, index) in links_" v-bind:key="index">
                                            <li class="list-group-item">
                                                <strong v-if="usePage().props.auth.user.admin_level >= n.admin">{{n.by}}: </strong><a  v-if="usePage().props.auth.user.admin_level >= n.admin" class="py-4" :href="n.link" target="_blank">{{ n.link }}</a>
                                                <span v-if="usePage().props.auth.user.admin_level > 5" class="d-flex justify-content-end">
                                                    <form method="GET" @submit.prevent="form.delete(route('dashboard.delete', { id: n.id }))">
                                                        <button type="submit" class="btn btn-outline-danger"> Delete</button>
                                                    </form>
                                                </span>    
                                            </li>
                                        </ul>
                                    </div>

                            </div>
                        </div>
                    </div>
                </div> -->

        <div class="py-12 container text-center">
            <div class="row row-cols-lg-5 g-2 g-lg-3">
                <div class="col" v-for="(n, index) in links_" v-bind:key="index">
                    <div v-if="usePage().props.auth.user.admin_level >= n.admin" class="shadow bg-body border bg-light rounded">
                        <div class="content-image">
                            <img style="display: block;max-width: 100%; height: 250px; cursor: pointer;"
                                :src="`http://192.168.0.249:1880/getImage_ctc?link=/Public/MTM/imagini_tablete/LINKS_photos/&code=${n.location}`"
                                :alt="n.location"
                                @click.stop="openLink(n.link)"
                                >
                        </div>
                        <div class="d-flex align-items-start flex-column bd-highlight p-1">
                            <div class="p-1 bd-highlight">
                                <strong>
                                    {{ n.by }}
                                </strong>
                            </div>
                            
                            <div class="p-1 bd-highlight text-secondary">
                                {{ n.description }}
                            </div>

                            <div class="bg-dark w-100"></div>

                            <span v-if="usePage().props.auth.user.admin_level > 5" class="d-flex justify-content-end p-1">
                                <form method="GET" @submit.prevent="form.delete(route('dashboard.delete', { id: n.id }))">
                                    <button type="submit" class="btn btn-outline-danger"> Delete</button>
                                </form>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
