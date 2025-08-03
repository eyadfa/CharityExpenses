<template>
    <div>
        <input type="file" @change="selectFile" />
        <button @click="previewFile">Preview File</button>

        <div v-if="isPreviewOpen" class="modal">
            <div class="modal-content">
                <template v-if="isDocument(file)">
                    <!-- Display document content -->
                    <div v-html="sanitizedDocumentContent"></div>
                </template>
                <template v-else-if="isExcel(file)">
                    <!-- Display Excel content -->
                    <table>
                        <tr v-for="row in excelData" :key="row">
                            <td v-for="cell in row" :key="cell">{{ cell }}</td>
                        </tr>
                    </table>
                </template>
                <template v-else-if="isPDF(file)">
                    <!-- Display PDF -->
                    <embed :src="file.url" type="application/pdf" width="100%" height="600px" />
                </template>
                <template v-else-if="isImage(file)">
                    <!-- Display image -->
                    <img :src="file.url" alt="Preview" />
                </template>
                <template v-else-if="isVideo(file)">
                    <!-- Display video -->
                    <video controls :src="file.url">
                        Your browser does not support the video tag.
                    </video>
                </template>
                <template v-else>
                    Unknown file type
                </template>
            </div>
            <button @click="closePreview">Close Preview</button>
        </div>
    </div>
</template>

<script>
import { read, utils } from 'xlsx';
import { Docxtemplater } from 'docxtemplater';
import DOMPurify from "dompurify";

export default {
    name:"FilePreview",
    data() {
        return {
            isPreviewOpen: false,
            file: null,
            documentContent: '',
            excelData: [],
        };
    },
    methods: {
        selectFile(event) {
            this.file = event.target.files[0];
        },
        previewFile() {
            if (this.file) {
                this.isPreviewOpen = true;
                if (this.isDocument(this.file)) {
                    this.loadDocumentFile();
                } else if (this.isExcel(this.file)) {
                    this.loadExcelFile();
                }
            }
        },
        closePreview() {
            this.isPreviewOpen = false;
            this.file = null;
            this.documentContent = '';
            this.excelData = [];
        },
        isDocument(file) {
            return /\.(doc|docx)$/i.test(file.name);
        },
        isExcel(file) {
            return /\.(xlsx|xls)$/i.test(file.name);
        },
        isPDF(file) {
            return /\.(pdf)$/i.test(file.name);
        },
        isImage(file) {
            return /\.(jpg|jpeg|png|gif)$/i.test(file.name);
        },
        isVideo(file) {
            return /\.(mp4)$/i.test(file.name);
        },
        loadDocumentFile() {
            const reader = new FileReader();
            reader.onload = () => {
                const buffer = reader.result;
                const doc = new Docxtemplater().loadZip(buffer);
                doc.render();
                this.documentContent = doc.getFullText();
            };
            reader.readAsArrayBuffer(this.file);
        },
        loadExcelFile() {
            const reader = new FileReader();
            reader.onload = () => {
                const buffer = reader.result;
                const workbook = read(buffer, { type: 'array' });
                const sheet = workbook.Sheets[workbook.SheetNames[0]];
                const data = utils.sheet_to_json(sheet, { header: 1 });
                this.excelData = data;
            };
            reader.readAsArrayBuffer(this.file);
        },
    },

    computed: {
        sanitizedDocumentContent() {
            return DOMPurify.sanitize(this.documentContent);
        }
    }
};
</script>
