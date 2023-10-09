<template>

    <img id="avatarButton" type="button" data-dropdown-toggle="userDropdown" data-dropdown-placement="bottom-start" class="w-10 h-10 rounded-full cursor-pointer" src="https://upload.wikimedia.org/wikipedia/commons/8/89/Portrait_Placeholder.png" alt="User dropdown">

    <div id="userDropdown" class="hidden">
        <h1>Hello</h1>
    </div>

</template>
<script>
    import { ref } from 'vue'
</script>