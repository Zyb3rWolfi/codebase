<template>
        <div v-if="props.title" id="sharedBlock" class="my-16 flex justify-evenly">
            <div class=" flex-initial w-1/2">
                <CodeEditor font-size="15px" :value="props.code" width="100%" height="600px" :read-only="true" :languages="[[props.language]]" />
            </div>
            <div class=" flex-2">
                <h1 id="title" class=" text-2xl">{{ props.title }}</h1>
                <h1 id="" class=" text-md mt-5">{{ props.description }}</h1>
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