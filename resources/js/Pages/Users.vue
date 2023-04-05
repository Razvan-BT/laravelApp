
<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';

const propsDefinition = defineProps({
  user: {
    type: Object,
    required: true
  },
});

let id = propsDefinition.user.id;

console.log("Current ID of user: " + id);

const form = useForm({
  name: propsDefinition.user.name,
  adminDataRequest: propsDefinition.user.admin_level
});

</script>


<template>
  <Head title="Profile" />
  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
    </template>


    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <Transition class="transition ease-in-out">
          <div v-if="form.recentlySuccessful" class="alert alert-success" role="alert">
            Successfully option changed!
          </div>
        </Transition>
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

          <div class="p-6 text-gray-900">

            <h1><strong>User name:</strong> {{ user.name }}</h1>

            <p><strong>User email address:</strong> {{ user.email }}</p>

            <p><strong>Admin level:</strong> {{ user.admin_level == '0' ? 'No admin' : user.admin_level }}</p>

            <form method="POST" @submit.prevent="form.post(route('users.change', { id: user.id }))">

              <div class="mt-2">
                <strong>Force name change: </strong>
                <TextInput id="name" type="text" class="mt-1 block w-25" v-model="form.name" required />
              </div>

              <div class="mt-2">
                <strong>Set admin level: </strong>
                <TextInput id="adminDataRequest" min="0" max="6" type="number" class="mt-1 block w-25"
                  v-model="form.adminDataRequest" required />
              </div>

              <div class="flex justify-start mt-4">

                <PrimaryButton type="submit">
                  Confirm
                </PrimaryButton>

              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
