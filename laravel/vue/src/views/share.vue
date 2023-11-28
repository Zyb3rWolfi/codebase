<template>
        <div v-if="props.title" id="sharedBlock" class="my-16 fixed mx-auto top-0 left-0 right-0 z-50 w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative mx-auto w-full max-w-6xl max-h-full">
                <!-- Modal content -->
                <div class="relative rounded-lg shadow bg-gray-700">

                    <div class="px-8 pb-8 py-10 lg:px-20">
                        <h3 id="title" class="mb-4 text-xl font-medium text-white">{{ props.title }}</h3>
                        <p id="sub" class="mb-5">{{ props.description }}</p>
                        <CodeEditor font-size="15px" :value="props.code" width="100%" height="600px" :read-only="true" :languages="[[props.language]]" />
                    </div>
                    
                </div> 
            </div>
        </div>    
</template>
<script setup>
import { onBeforeMount, onMounted, ref } from 'vue';
import {useRoute } from 'vue-router';
import axios from 'axios';
import CodeEditor from "simple-code-editor";


const apiUrl = import.meta.env.VITE_API_BASE_URL
var props = ref([])
const route = useRoute() // access the router

async function getResponse(token, header) {
            // If the search is empty we will empty the answer array and return
            if (token === '') {
                answer = [];
                return;
            }
            // Otherwise we will make a request to the api and set the answer array to the response
            const response = await axios.get(apiUrl + '/api/getSharedBlock/' + token, {headers: header, withCredentials: true});
            var answer = response.data["strings"];
            console.log(answer)
            props.value = answer[0]
            console.log(props)
        } 

    onMounted(() => {
        console.log('mounted')
              
    });
    onBeforeMount(() => {
        var $token = route.params.token // access the token parameter from the url

        var header = {
            Accept: 'application/json',
            'content-type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        }
        getResponse($token, header)
        console.log("before mount")
        
    });

</script>