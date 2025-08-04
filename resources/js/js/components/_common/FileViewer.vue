<template>
    <div>
        <!-- Modal Trigger -->
        <button @click="openModal">Open Modal</button>
        <input type="radio" v-model="file" value="uploads/_f/1.docx">
        <input type="radio" v-model="file" value="uploads/_f/2.xlsx">
        <input type="radio" v-model="file" value="uploads/_f/3.pdf">
        <input type="radio" v-model="file" value="uploads/_f/4.png">
        <!-- Modal -->
        <div v-if="isModalOpen" class="modal">
            <div class="modal-content">
                <!-- Display different file types based on their extensions -->
                <template v-if="isImage(file)">
                    <viewer :images="[file]"></viewer>
                </template>
                <template v-else-if="isPDF(file)">
                </template>
                <template v-else-if="isDocument(file) || isExcel(file)">
                    <!-- Display a download link for doc and xlsx files -->
                    <a :href="file" download>{{ file }}</a>
                </template>
                <template v-else>
                    Unknown file type
                </template>
            </div>
            <button @click="closeModal">Close Modal</button>
        </div>
    </div>
</template>


<script>
import { Viewer } from 'vue-viewer';
import VueGallery from 'vue-gallery';
export default {
    name: "file_viewer",
    components: {
        Viewer,
        VueGallery,
    },
    data() {
        return {
            isModalOpen: false,
            file: "",
        };
    },
    methods: {
        openModal() {
            this.isModalOpen = true;
        },
        closeModal() {
            this.isModalOpen = false;
        },
        isImage(file) {
            return /\.(jpeg|jpg|png|gif)$/i.test(file);
        },
        isPDF(file) {
            return /\.pdf$/i.test(file);
        },
        isDocument(file) {
            return /\.(docx|doc)$/i.test(file.name);
        },
        isExcel(file) {
            return /\.(xlsx|xls)$/i.test(file.name);
        },
        loadDocumentFile() {
            const xhr = new XMLHttpRequest();
            xhr.open('GET', this.file.url, true);
            xhr.responseType = 'arraybuffer';

            xhr.onload = () => {
                const buffer = xhr.response;
                const doc = new Docxtemplater().loadZip(new JSZip(buffer));
                doc.render(); // Render any variables in the document
                this.documentContent = doc.getFullText();
            };

            xhr.send();
        },
    },
}
</script>

