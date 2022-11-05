<script setup>
import AppLayoutVue from '../../Layouts/AppLayout.vue';
import FormSection from '../../Components/FormSection.vue';
import InputLabel from '../../Components/InputLabel.vue';
import TextInput from '../../Components/TextInput.vue';
import InputError from '../../Components/InputError.vue';
import PrimaryButton  from '../../Components/PrimaryButton.vue';
import { useForm } from '@inertiajs/inertia-vue3';

  const data = defineProps({
    category: Object,
})
const form = useForm({
    name:data.category.name,
    type:data.category.type,
});

function enviar() {
     form.put(route('category.update',data.category.id));
     //// put o patch  para editar /
}
</script>
<template>
    <AppLayoutVue>
        <template #header>
            Formulario para editar una categoria
        </template>

        <template #default>
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <FormSection @submitted="enviar()">

                    <template #title> Titulo </template>
                    <template #description> descripcion </template>

                    <template #form>
                        <div class="col-span-4 sm:col-span-4">
                            <InputLabel for="name" value="Nombre" />
                            <TextInput type="text" name="name" id="name" v-model="form.name" class="w-full" ></TextInput>
                            <InputError v-bind:message="form.errors.name" ></InputError>
                        </div>

                        <div class="col-span-4 sm:col-span-4">
                            <InputLabel for="name" value="Tipo" />
                            <TextInput type="text" name="type" id="type" v-model="form.type" class="w-full"> </TextInput>
                            <InputError v-bind:message="form.errors.type" ></InputError>

                        </div>

                    </template>
                    <template #actions>
                        <PrimaryButton type="submit"> Editar </PrimaryButton>    
                    
                    </template>


                </FormSection>
            </div>
        </template>

    </AppLayoutVue>
</template>