<script setup>
import AppLayoutVue from "../../Layouts/AppLayout.vue";
import ActionSection from "../../Components/ActionSection.vue";
import DialogModal from "../../Components/DialogModal.vue";
import SecondaryButton from "../../Components/SecondaryButton.vue";
import FormSection from "../../Components/FormSection.vue";
import InputLabel from '../../Components/InputLabel.vue';
import TextInput from '../../Components/TextInput.vue';
import InputError from '../../Components/InputError.vue';
import PrimaryButton  from '../../Components/PrimaryButton.vue';
import { Link, useForm  } from "@inertiajs/inertia-vue3";
import { ref } from "vue";
import { Inertia } from "@inertiajs/inertia";
const data = defineProps({
    products: Array,
    categories: Array,
    user:Object,
    q: String,
    product: Object,
   showDialogShow: Boolean,
   showDialogForm: Boolean,

});

///const showDialogShow = ref(false);
///const showDialogForm = ref(false);
///const showDialogUpdate = ref(false);
const showDialogDelete = ref(0);

const Form = useForm({
'name' : data.product?.name ?? '',
'price' : data.product?.price ?? '',
'stock' : data.product?.stock ?? '',
'user_id' : data.user.id,
'category_id' : data.product?.category_id ?? '',
});

const enviarForm = () => {

     if (data.product){
        ////editar
        Form.put(route('product.update',data.product.id),{
        onSuccess: () => {
            Inertia.visit(route('product.index'));
            }
        
       });

     }else{
        /////nuevo
        Form.post(route('product.store'),{
        onSuccess: () => {
            data.showDialogForm = false;
            form.reset();
        }
    });


     }
    

   
}

const cancelarForm= () =>{
    Inertia.visit(route('product.index'));
}


const enviarBuscar = () => {
    Inertia.visit(route('product.index', { q : data.q }));
}
const enviarMostrar = (id) => {
  Inertia.visit(route('product.index', {show : id}));
}
const cancelarMostrar = () =>{
    Inertia.visit(route('product.index'));
}
const mostrarEditar = (id) =>{
    Inertia.visit(route('product.index', {edit : id}));
}
 
const enviarEliminar = () =>{
useForm().delete(route('product.destroy', showDialogDelete.value),{
    onSuccess: () => {
        showDialogDelete.value = 0;
    }
});
}

</script>
<template>
    <AppLayoutVue>
        <template #header>
            <SecondaryButton
                class="m-2 py-2 px-4 bg-indigo-400 hover:bg-indigo-700 rounded"
                @click="showDialogForm = true" >Nuevo
            </SecondaryButton>
        </template>

        <div class="max-w-7xl mx-auto py-6 px-4 sn:px-6 lg:px-8">
            <ActionSection>
                <template #title> Lista de productos</template>
                <template #description> Para ver productos</template>
                <template #content>
                    <TextInput type="text" name="q" id="q" v-model="q" class="w-full mb-2" @change="enviarBuscar"></TextInput>
                    <table class="w-full">
                        <thead>
                            <tr class="text-left"> 
                                <th>Nombre</th>
                                <th>Precio</th>
                                <th>Cantidad</th>
                                <th>Ver</th>
                                <th>Editar</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="product in products">
                                <td>{{ product.name }}</td>
                                <td>{{ product.price }}</td>
                                <td>{{ product.stock }}</td>
                                <td>
                                    <SecondaryButton
                                        class="m-2 py-2 px-4 bg-indigo-400 hover:bg-indigo-700 rounded"
                                        @click="enviarMostrar(product.id)" >Ver
                                    </SecondaryButton>
                                </td>
                                <td>
                                    <SecondaryButton
                                        class="m-2 py-2 px-4 bg-orange-400 hover:bg-indigo-700 rounded"
                                        @click="mostrarEditar(product.id)">Editar
                                    </SecondaryButton>
                                </td>
                                <td>
                                    <SecondaryButton class="m-2 py-2 px-4 bg-red-400 hover:bg-indigo-700 rounded"
                                        @click="showDialogDelete = product.id "> Eliminar </SecondaryButton>
                                </td>
                            </tr> 
                        </tbody>
                    </table>
                </template>
            </ActionSection>
        </div>
    </AppLayoutVue>

    <DialogModal v-bind:show="showDialogShow">
        <template #title> Mostrar Producto </template>
        <template #content>
         <p>Nombre: {{product?.name ?? ''}}</p>
         <p>Precio: {{product?.price ?? ''}}</p>
         <p>Stock: {{product?.stock ?? ''}}</p>
        </template>
        <template #footer>
            <SecondaryButton @click="cancelarMostrar"
                >Cancelar</SecondaryButton
            >
        </template>
    </DialogModal>

    <DialogModal v-bind:show="showDialogForm">
        <template #title> {{ product ? 'Editar Producto' : 'Nuevo Producto' }} </template>
        <template #content> 
             
               <form @submit.prevent="enviarForm()">
                <div class="grid grid-cols-6 gap-6">
                    <div class="col-span-6 sm:col-span-4">
                        <InputLabel for="name" value="Nombre" />
                        <TextInput  type="text" name="name" id="name" v-model="Form.name"  class="w-full"></TextInput>
                        <InputError v-bind:message="Form.errors.name" ></InputError>
                    </div>
                    <div class="col-span-6 sm:col-span-4">
                        <InputLabel for="name" value="Precio" />
                        <TextInput type="number" name="price" id="price" v-model="Form.price"  class="w-full"></TextInput>
                        <InputError v-bind:message="Form.errors.price" ></InputError>
                    </div>
                    <div class="col-span-6 sm:col-span-4">
                        <InputLabel for="stock" value="Cantidad" />
                        <TextInput type="number" name="stock" id="stock" v-model="Form.stock"  class="w-full"></TextInput>
                        <InputError v-bind:message="Form.errors.stock" ></InputError>
                    </div>

                    <div class="col-span-6 sm:col-span-4">
                        <InputLabel for="category" value="Categoria" />
                        <select name="category" id="category" v-model="Form.category_id"  
                        class=" border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full">
                            <option v-for="category in categories " v-bind:value="category.id" >{{category.name}}</option>
                        </select>
                        <InputError v-bind:message="Form.errors.category_id" ></InputError>
                    </div>

                     <div class="col-span-6 text-end ">
                    <PrimaryButton class="mr-2"> {{ product ? 'Editar' : 'Guardar' }} </PrimaryButton>
                    <SecondaryButton @click="cancelarForm" >Cancelar</SecondaryButton >
                    </div>

                  </div>
                </form>
        </template>
       
    </DialogModal>
    
    <DialogModal v-bind:show="showDialogDelete > 0">
        <template #title> Eliminar Producto </template>
        <template #content>
            <p> ¿ Seguro que desea eliminar el producto " 
                <span>{{products.find(product => product.id == showDialogDelete)?.name ?? ''}}</span>
                "?</p>
        </template>
        <template #footer>
            <PrimaryButton type="button" @click="enviarEliminar">Si</PrimaryButton>
            <SecondaryButton @click="showDialogDelete = false">No</SecondaryButton>
        </template>
    </DialogModal>

</template>
