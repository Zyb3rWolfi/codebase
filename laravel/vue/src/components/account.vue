<template class="">
    <div class="grid lg:grid-cols-6 sm:grid-cols-4 md:cols-4 mx-auto justify-center">
        <p class="text-2xl font-semibold col-start-2">Account Settings</p>
        <p class="mt-5 mb-5 font-semibold col-start-2">Your Details</p>
        <div class="container grid col-start-2">
        <form class="row-start-1">
            <div class="relative z-0 w-full mb-6 group">
        <input v-model="user_name" type="text" name="floating_name" id="floating_name" class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b-2  appearance-none text-white border-gray-600 focus:border-blue-500 focus:outline-none focus:ring-0 peer" placeholder=" " required />
        <label for="floating_name" class="peer-focus:font-medium absolute text-sm text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Your Name</label>
            </div>
            <div class="relative z-0 w-full mb-6 group">
                <input v-model="user_email" type="email" name="floating_email" id="floating_email" class="block py-2.5 px-0 w-full text-sm  bg-transparent border-0 border-b-2  appearance-none text-white border-gray-600 focus:border-blue-500 focus:outline-none focus:ring-0 peer" placeholder=" " required />
                <label for="floating_email" class="peer-focus:font-medium absolute text-sm  text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Email address</label>
                <p v-if="changed" class=" text-sm mt-2 text-gray-400">Your Details Where Changed</p>
                <p v-if="emailAlreadyExists" class=" text-sm mt-2 text-gray-400">Email Already Exists!</p>
            </div>
            <button @click="changeDetails()" type="button" class="text-white  focus:ring-4 focus:outline-none  font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center bg-blue-600 hover:bg-blue-700 focus:ring-blue-800">Change</button>
            <div v-show="passwordAlreadyExists">
                <p class="mt-5 mb-5 font-semibold">Change Password</p>
                <div class="relative z-0 w-full mb-6 group">
                    <input v-model="user_password" type="password" name="floating_password" id="floating_password" class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b-2 border-gray-600 appearance-none text-white border-gray-600focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                    <label for="floating_password" class="peer-focus:font-medium absolute text-sm text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Old Password</label>
                </div>
                <div class="relative z-0 w-full mb-6 group">
                    <input v-model="user_new_password" type="password" name="new_password" id="floating_new_password" class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b-2 appearance-none text-white border-gray-600 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                    <label for="floating_new_password" class="peer-focus:font-medium absolute text-sm text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Password</label>
                    <p v-if="changed2" class=" text-sm mt-2 text-gray-400">Your Details Where Changed</p>
                    <p v-if="textToggle" class=" text-sm mt-2 text-gray-400">{{ textPlaceholder }}</p>
                </div>
                <button @click="changePassword()" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Confirm</button>
                

            </div>
            <h3 class="mb-5 text-lg font-medium mt-5 text-white">Auth Method</h3>

            <ul class="grid w-full gap-6 md:grid-cols-3">
                <li @mouseenter="this.google_over = true" @mouseleave="this.google_over = false" id="google">
                    <div v-if="!this.google" @click="addGoogle()">
                        <label for="react-option" class="inline-flex items-center justify-center w-full p-5 text-gray-500  border-2  rounded-lg cursor-pointer  border-gray-700 peer-checked:border-blue-600 hover:text-gray-600 peer-checked:text-gray-300   dark:text-gray-400 bg-gray-800 hover:bg-gray-700">                           
                            <div class="block">
                                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 19">
                                     <path fill-rule="evenodd" d="M8.842 18.083a8.8 8.8 0 0 1-8.65-8.948 8.841 8.841 0 0 1 8.8-8.652h.153a8.464 8.464 0 0 1 5.7 2.257l-2.193 2.038A5.27 5.27 0 0 0 9.09 3.4a5.882 5.882 0 0 0-.2 11.76h.124a5.091 5.091 0 0 0 5.248-4.057L14.3 11H9V8h8.34c.066.543.095 1.09.088 1.636-.086 5.053-3.463 8.449-8.4 8.449l-.186-.002Z" clip-rule="evenodd"/>
                                </svg>                
                            </div>
                        </label>
                    </div>
                    <div data-modal-target="remove-google-modal" data-modal-toggle="remove-google-modal" class="active" v-if="this.google">
                        <label for="react-option" class="inline-flex items-center justify-center w-full p-5  border-2  rounded-lg cursor-pointer  border-gray-700 peer-checked:border-blue-600 hover:text-gray-600 dark:peer-checked:text-gray-300 peer-checked:text-gray-600 text-gray-400 bg-gray-800 hover:bg-gray-700">                           
                            <div class="block">
                                <svg v-show="!this.google_over" class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 19">
                                     <path fill-rule="evenodd" d="M8.842 18.083a8.8 8.8 0 0 1-8.65-8.948 8.841 8.841 0 0 1 8.8-8.652h.153a8.464 8.464 0 0 1 5.7 2.257l-2.193 2.038A5.27 5.27 0 0 0 9.09 3.4a5.882 5.882 0 0 0-.2 11.76h.124a5.091 5.091 0 0 0 5.248-4.057L14.3 11H9V8h8.34c.066.543.095 1.09.088 1.636-.086 5.053-3.463 8.449-8.4 8.449l-.186-.002Z" clip-rule="evenodd"/>
                                </svg>   
                                <svg v-show="this.google_over" class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h16M7 8v8m4-8v8M7 1h4a1 1 0 0 1 1 1v3H6V2a1 1 0 0 1 1-1ZM3 5h12v13a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V5Z"/>
                                </svg>             
                            </div>
                        </label>
                    </div>
                </li>

                <li @mouseenter="this.github_over = true" @mouseleave="this.github_over = false" id="github">
                    <div data-modal-target="remove-github-modal" data-modal-toggle="remove-github-modal" class="active" v-if="this.github">
                        <label for="flowbite-option" class="inline-flex items-center justify-center w-full p-5 border-2 border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 peer-checked:border-blue-600 hover:text-gray-600 dark:peer-checked:text-gray-300 peer-checked:text-gray-600 hover:bg-gray-50 text-gray-400 bg-gray-800 hover:bg-gray-700">
                            <div class="block">
                            <svg v-show="!this.github_over" class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 .333A9.911 9.911 0 0 0 6.866 19.65c.5.092.678-.215.678-.477 0-.237-.01-1.017-.014-1.845-2.757.6-3.338-1.169-3.338-1.169a2.627 2.627 0 0 0-1.1-1.451c-.9-.615.07-.6.07-.6a2.084 2.084 0 0 1 1.518 1.021 2.11 2.11 0 0 0 2.884.823c.044-.503.268-.973.63-1.325-2.2-.25-4.516-1.1-4.516-4.9A3.832 3.832 0 0 1 4.7 7.068a3.56 3.56 0 0 1 .095-2.623s.832-.266 2.726 1.016a9.409 9.409 0 0 1 4.962 0c1.89-1.282 2.717-1.016 2.717-1.016.366.83.402 1.768.1 2.623a3.827 3.827 0 0 1 1.02 2.659c0 3.807-2.319 4.644-4.525 4.889a2.366 2.366 0 0 1 .673 1.834c0 1.326-.012 2.394-.012 2.72 0 .263.18.572.681.475A9.911 9.911 0 0 0 10 .333Z" clip-rule="evenodd"/>
                                </svg> 
                            <svg v-show="this.github_over" class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h16M7 8v8m4-8v8M7 1h4a1 1 0 0 1 1 1v3H6V2a1 1 0 0 1 1-1ZM3 5h12v13a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V5Z"/>
                            </svg>
                            </div>
                        </label>
                    </div>
                    <div class="" v-if="!this.github" @click="addGithub()">
                        <label for="flowbite-option" class="inline-flex items-center justify-center w-full p-5  border-2  rounded-lg cursor-pointer hover:text-gray-300 border-gray-700 peer-checked:border-blue-600  peer-checked:text-gray-300   text-gray-400 bg-gray-800 hover:bg-gray-700">
                            <div class="block">
                            <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 .333A9.911 9.911 0 0 0 6.866 19.65c.5.092.678-.215.678-.477 0-.237-.01-1.017-.014-1.845-2.757.6-3.338-1.169-3.338-1.169a2.627 2.627 0 0 0-1.1-1.451c-.9-.615.07-.6.07-.6a2.084 2.084 0 0 1 1.518 1.021 2.11 2.11 0 0 0 2.884.823c.044-.503.268-.973.63-1.325-2.2-.25-4.516-1.1-4.516-4.9A3.832 3.832 0 0 1 4.7 7.068a3.56 3.56 0 0 1 .095-2.623s.832-.266 2.726 1.016a9.409 9.409 0 0 1 4.962 0c1.89-1.282 2.717-1.016 2.717-1.016.366.83.402 1.768.1 2.623a3.827 3.827 0 0 1 1.02 2.659c0 3.807-2.319 4.644-4.525 4.889a2.366 2.366 0 0 1 .673 1.834c0 1.326-.012 2.394-.012 2.72 0 .263.18.572.681.475A9.911 9.911 0 0 0 10 .333Z" clip-rule="evenodd"/>
                                </svg> 
                            </div>
                        </label>
                    </div>
                </li>

                <li v-show="!this.passwordAlreadyExists" id="null" data-modal-target="add-password-modal" data-modal-toggle="add-password-modal">
                    <label for="angular-option" class="inline-flex items-center justify-center w-full p-5 border-2  rounded-lg cursor-pointer dark:hover:text-gray-300 border-gray-700 peer-checked:border-blue-600 hover:text-gray-600 dark:peer-checked:text-gray-300 peer-checked:text-gray-600  text-gray-400 bg-gray-800 hover:bg-gray-700">
                        <div class="block">
                            <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 20">
                                <path d="M14 7h-1.5V4.5a4.5 4.5 0 1 0-9 0V7H2a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2Zm-5 8a1 1 0 1 1-2 0v-3a1 1 0 1 1 2 0v3Zm1.5-8h-5V4.5a2.5 2.5 0 1 1 5 0V7Z"/>
                            </svg>
                        </div>
                    </label>
                </li>
                <li @mouseenter="this.password_over = true" @mouseleave="this.password_over = false" v-show="this.passwordAlreadyExists" class="active" id="null" data-modal-target="remove-password-modal" data-modal-toggle="remove-password-modal">
                    <label for="angular-option" class="inline-flex items-center justify-center w-full p-5  border-2  rounded-lg cursor-pointer hover:text-gray-300 border-gray-700 peer-checked:border-blue-600 hover:text-gray-600 peer-checked:text-gray-300   text-gray-400 bg-gray-800 hover:bg-gray-700">
                        <div class="block">
                            <svg v-show="!this.password_over" class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 20">
                                <path d="M14 7h-1.5V4.5a4.5 4.5 0 1 0-9 0V7H2a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2Zm-5 8a1 1 0 1 1-2 0v-3a1 1 0 1 1 2 0v3Zm1.5-8h-5V4.5a2.5 2.5 0 1 1 5 0V7Z"/>
                            </svg>
                            <svg v-show="this.password_over" class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h16M7 8v8m4-8v8M7 1h4a1 1 0 0 1 1 1v3H6V2a1 1 0 0 1 1-1ZM3 5h12v13a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V5Z"/>
                            </svg>
                        </div>
                    </label>
                </li>
            </ul>
        </form>
        <button data-modal-target="popup-modal" data-modal-toggle="popup-modal" type="button" class="text-white mt-10 bg-red-800 hover:bg-red-900 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Delete Account</button>
    
    </div>
        
    </div>

    <!-- Delete account modal -->
    <div id="popup-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative  rounded-lg shadow bg-gray-700">
            <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent  rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center hover:bg-gray-600 hover:text-white" data-modal-hide="popup-modal">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="p-4 md:p-5 text-center">
                <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                </svg>
                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to delete your account?</h3>
                <button @click="deleteAccount()" data-modal-hide="popup-modal" type="button" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none  focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center me-2">
                    Yes, I'm sure
                </button>
                <button data-modal-hide="popup-modal" type="button" class="focus:ring-4 focus:outline-none  rounded-lg border text-sm font-medium px-5 py-2.5 focus:z-10 bg-gray-700 text-gray-300 border-gray-500 hover:text-white hover:bg-gray-600 focus:ring-gray-600">No, cancel</button>
            </div>
        </div>
        </div>
    </div>

    <!-- Remove Password modal-->
    <div id="remove-password-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative rounded-lg shadow bg-gray-700">
            <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent  rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center hover:bg-gray-600 hover:text-white" data-modal-hide="remove-password-modal">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="p-4 md:p-5 text-center">
                <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                </svg>
                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to remove your password?</h3>
                <button @click="removeePassword()" data-modal-hide="remove-password-modal" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center me-2">
                    Yes, I'm sure
                </button>
                <button data-modal-hide="remove-password-modal" type="button" class=" focus:ring-4 focus:outline-none  rounded-lg border  text-sm font-medium px-5 py-2.5 focus:z-10 bg-gray-700 text-gray-300 border-gray-500 hover:text-white hover:bg-gray-600 focus:ring-gray-600">No, cancel</button>
            </div>
        </div>
        </div>
    </div>

    <!-- Remove Github modal-->
    <div id="remove-github-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative rounded-lg shadow bg-gray-700">
            <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent  rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center hover:bg-gray-600 hover:text-white" data-modal-hide="remove-github-modal">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="p-4 md:p-5 text-center">
                <svg class="mx-auto mb-4  w-12 h-12 text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                </svg>
                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to remove the Github Connection?</h3>
                <button @click="removeGithub()" data-modal-hide="remove-github-modal" type="button" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none  focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center me-2">
                    Yes, I'm sure
                </button>
                <button data-modal-hide="remove-github-modal" type="button" class=" focus:ring-4 focus:outline-none  rounded-lg border  text-sm font-medium px-5 py-2.5  focus:z-10 bg-gray-700 text-gray-300 border-gray-500 hover:text-white hover:bg-gray-600 focus:ring-gray-600">No, cancel</button>
            </div>
        </div>
        </div>
    </div>

    <!-- Remove Google modal-->
    <div id="remove-google-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative rounded-lg shadow bg-gray-700">
            <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center hover:bg-gray-600 hover:text-white" data-modal-hide="remove-google-modal">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="p-4 md:p-5 text-center">
                <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                </svg>
                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to remove the Google Connection?</h3>
                <button @click="removeGoogle()" data-modal-hide="remove-google-modal" type="button" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none  focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center me-2">
                    Yes, I'm sure
                </button>
                <button data-modal-hide="remove-google-modal" type="button" class=" focus:ring-4 focus:outline-none  rounded-lg border text-sm font-medium px-5 py-2.5  focus:z-10 bg-gray-700 text-gray-300 border-gray-500 hover:text-white hover:bg-gray-600 focus:ring-gray-600">No, cancel</button>
            </div>
        </div>
        </div>
    </div>

        <!-- Main modal -->
        <div id="add-password-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <!-- Modal content -->
                <div class="relative rounded-lg shadow bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-white">
                            Setup password login
                        </h3>
                        <button type="button" class="end-2.5 text-gray-400 bg-transparent hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center hover:bg-gray-600 " data-modal-hide="add-password-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-4 md:p-5">
                        <div class="space-y-4" action="#">
                            <div>
                                <label for="password" class="block mb-2 text-sm font-medium text-white">Your password</label>
                                <input v-model="this.addPasswordPayload.user_password" type="password" name="password" id="password" placeholder="••••••••" class=" border  text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 bg-gray-600 border-gray-500 placeholder-gray-400 text-white" required>
                            </div>
                            <button data-modal-hide="add-password-modal" @click="this.setPasswordForUser()" class="w-full text-white  focus:ring-4 focus:outline-none  font-medium rounded-lg text-sm px-5 py-2.5 text-center bg-blue-600 hover:bg-blue-700 focus:ring-blue-800">Turn on password login</button>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
        <footerComp class=""/>
</template>

<script>
import axios from 'axios';
const apiUrl = import.meta.env.VITE_API_BASE_URL
import { initFlowbite } from 'flowbite'
import { ref } from 'vue'
import { useStore } from 'vuex';
import footerComp from './footer.vue'

export default  {
    // Returns all data that is associated with the account 
    data() {
        return {
            user_name: '',
            user_email: '',
            user_password: '',
            user_new_password: '',

            accountDetails: {
                name: '',
                email: '',
            },
            addPasswordPayload: {
                user_password: ''
            },
            changed: false,
            changed2: false,
            emailAlreadyExists: false,
            passwordAlreadyExists: false,
            github: ref(false),
            google: false,
            passwordLogin: false,
            textPlaceholder: 'placeholder',
            textToggle: false,

            // Variables for the providers
            providers: [],
            page_loaded: false,
            github_over: false,
            google_over: false,
            password_over: false,
            
            // Headers for API requests
            headers: {
            Accept: 'application/json',
            'content-type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest',
            'Authorization': 'Bearer ' + localStorage.getItem('token')
        }
    }
},
components: {
    footerComp
},
setup() {
    const store = useStore()
    return { store }
},

async mounted() {
   // This function is responsible for getting the user details for the form to be filled 
   await this.getUser()

   // This gets all the providers that currently exist for the user
    await axios.get(apiUrl + '/api/getConnections', {headers: this.headers, withCredentials: true}).then(response => {
        for (let i = 0; i < response.data.length; i++) {
            switch (response.data[i]["provider"]) {
                case 'github':
                    this.github = true
                    break;
                case 'google':
                    this.google = true
                    break;
            }
            this.providers.push(response.data[i]["provider"])
        }
        
    })
    // This checks if the user has a password set
    await axios.get(apiUrl + '/api/passwordNull', {headers: this.headers, withCredentials: true}).then(response => {
        if (response.data["password"] == "not null") {
            this.providers.push('password')
            this.passwordLogin = true
            this.passwordAlreadyExists = true
        }
    })

    this.page_loaded = true

    initFlowbite()
},

methods: {

    // Removes the github connection
    async removeGithub() {
        await axios.post(apiUrl + '/api/removeGithub', [], {headers: this.headers, withCredentials: true}).then(response => {
            this.store.commit('ADD_TOAST', {
                title: "Removed Github Connection!",
                type: 'success',
                id: Math.floor(Math.random() * 50),
                duration: 5000
            })
            this.github = false
        }).catch(e => {
            this.store.commit('ADD_TOAST', {
                title: "Can't remove this connection! Must have password authentication enabled.",
                type: 'warning',
                id: Math.floor(Math.random() * 50),
                duration: 5000
            })
        })
    },

    // Adds a github connection
    async addGithub() {

        await axios.get(apiUrl + '/api/user', {headers: this.headers, withCredentials: true}).then(response => {
            const id = response.data["id"]
            window.location.href = apiUrl + `/auth/github?id=${id}` 
        
        })
        
        
    },
    // Adds a google connection
    async addGoogle() {
        await axios.get(apiUrl + '/api/user', {headers: this.headers, withCredentials: true}).then(response => {
            const id = response.data["id"]
            window.location.href = apiUrl + `/auth/google?id=${id}` 
        
        })
    },

    // Removes a google connection
    async removeGoogle() {
        await axios.post(apiUrl + '/api/removeGoogle', [], {headers: this.headers, withCredentials: true}).then(response => {
        this.store.commit('ADD_TOAST', {
            title: "Removed Google Connection!",
            type: 'success',
            id: Math.floor(Math.random() * 50),
            duration: 5000
        })
        this.google = false
        }).catch(e => {
            this.store.commit('ADD_TOAST', {
                title: "Can't remove this connection! Must have password authentication enabled.",
                type: 'warning',
                id: Math.floor(Math.random() * 50),
                duration: 5000
            })
        })
    },


    // Get user details
    async getUser() {
        await axios.get(apiUrl + '/api/user', {headers: this.headers, withCredentials: true}).then(response => {
        this.user_name = response.data["name"], this.user_email = response.data["email"]
    })
},
    // Delete account 
    deleteAccount() {
        axios.post(apiUrl + '/api/deleteAccount', [], {headers: this.headers, withCredentials: true}).then(response => {
            localStorage.removeItem('token')
            window.location.href = '/'
        })
    },

    // Details change request
    async changeDetails() {
        
        this.accountDetails.user_name = this.user_name
        this.accountDetails.user_email = this.user_email

        // calls the api to change the details
        await axios.post(apiUrl + '/api/changedetails', this.accountDetails, {headers: this.headers, withCredentials: true}).then(response => {
            this.changed = true
            this.emailAlreadyExists = false
        }).catch(error => {
            this.emailAlreadyExists = true // If the email already exists we will enable the prompt
        })
    },

    // Adds a password for the user as an authentication method
    async setPasswordForUser() {

        await axios.post(apiUrl + '/api/addPassword', this.addPasswordPayload, {headers: this.headers, withCredentials: true}).then(response => {
        this.passwordAlreadyExists = true
        })
        this.store.commit('ADD_TOAST', {
            title: "Added password login!",
            type: 'success',
            id: Math.floor(Math.random() * 50),
            duration: 5000
        })

    },

    // This removes the password as an authentication method
    async removeePassword() {

        if (this.github || this.google) {
            if (this.passwordAlreadyExists) {
                await axios.post(apiUrl + '/api/removePassword', [], {headers: this.headers, withCredentials: true}).then(response => {
                    password = true
                    this.store.commit('ADD_TOAST', {
                        title: "Removed password login!",
                        type: 'success',
                        id: Math.floor(Math.random() * 50),
                        duration: 5000
                    })
                
                    this.passwordAlreadyExists = false
                }).catch(error => {
                    this.store.commit('ADD_TOAST', {
                    title: "Cant remove password if there is no connections!",
                    type: 'warning',
                    id: Math.floor(Math.random() * 50),
                    duration: 5000
                })
                })
            }
        } else {
            this.store.commit('ADD_TOAST', {
            title: "Cant remove password if there is no connections!",
            type: 'warning',
            id: Math.floor(Math.random() * 50),
            duration: 5000
        })}

    },

    // Password change request
    async changePassword() {
    this.textToggle = false
    this.accountDetails.user_password = this.user_password
    this.accountDetails.user_new_password = this.user_new_password
    
    // Checks if the new password is long enough
    // Changes place holder if this is not the case
    if (this.accountDetails.user_new_password.length < 8) {
        this.textPlaceholder = 'Password must be at least 8 characters long'
        this.textToggle = true
        return
    }

    // Checks if the new password is the same as the old password
    // Changes place holder if this is the case
    if (this.accountDetails.user_new_password == this.accountDetails.user_password) {
        this.textPlaceholder = 'New password must be different from old password'
        this.textToggle = true
        return
    }

    // calls the api to change the password
    await axios.post(apiUrl + '/api/changePassword', this.accountDetails, {headers: this.headers, withCredentials: true}).then(response => {
        this.changed2 = true
    }).catch(error => {
        this.textPlaceholder = 'Old password is incorrect'
        this.textToggle = true
    })
}
},

}

</script>

<style scoped>

.active {
    border: white solid 2px;
    border-radius: 10%;
}

</style>