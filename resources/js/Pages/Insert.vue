
<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';

const form = useForm({

  link: '',
  adminDataRequest: '', // admin
  description: '',
  by: '',
  location: 'Productie',
});

console.log(form);

</script>


<template>
  <Head title="Add links" />
  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
    </template>


    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <Transition class="transition ease-in-out">
          <div v-if="form.recentlySuccessful" class="alert alert-success" role="alert">
            Successfully link added!
          </div>
        </Transition>
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

          <div class="p-6 text-gray-900">

            <form method="POST" @submit.prevent="form.post(route('dashboard.add'))">

              <div class="mt-2">
                <strong>Link: </strong>
                <TextInput id="name" type="text" class="mt-1 block w-50" v-model="form.link" required />
              </div>

              <div class="mt-2">
                <strong>Set admin level for link: </strong>
                <TextInput min="0" max="6" type="number" class="mt-1 block w-50"
                  v-model="form.adminDataRequest" required />
              </div>

              <div class="mt-2">
                <strong>Title: </strong>
                <TextInput type="text" placeholder="Eg. Broderie, Cornel, Cuttere, etc.." class="mt-1 block w-50"
                  v-model="form.by" required />
              </div>

              <div class="mt-2">
                <strong>Description: </strong>
                <TextInput type="text" placeholder="Something..." class="mt-1 block w-50"
                  v-model="form.description" required />
              </div>

              <!-- <div class="mt-2">
                <strong>Optional (location): </strong>
                <TextInput id="adminDataRequest" type="text" class="mt-1 block w-50"
                  v-model="form.location" required />
              </div> -->

              <div class="mt-2">
                <strong>Optional (location): </strong>
                <select class="mt-1 block w-50" v-model="form.location" aria-label="Select location (option for images)">
                  <option value="Broderie">Broderie</option>
                  <option value="CTC">CTC</option>
                  <option value="Cutters">Cutters</option>
                  <option value="Productie">Productie (default)</option>
                </select>
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
