<template>
    <div>
        <div class="mt-2 notification is-primary">
            Hi. Welcome to the product listing!
        </div>
        <input-file />
        <br>
        <p><b>Product Master List</b></p>
        <br>
        <data-table />
    </div>


</template>

<script>
import InputFile from './InputFile.vue';
import DataTable from './DataTable.vue';

export default {
    name: 'Hello',
    components: {
        InputFile,
        DataTable
    },
    data: function () {
        return {
            filter: '',
        }
    },
    mounted() {
    }
}
</script>