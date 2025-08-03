<template>
    <div>
        <template v-if="isImage">
            <img :src="fileUrl"  alt="غبر قادر على عرض الصورة" />
        </template>
        <template v-else-if="isVideo">
            <video   id="video" controls preload="metadata" >
                <source :src="fileUrl" type="video/mp4" />
                <!-- You can add more source elements for different video formats -->
            </video>
        </template>
        <template v-else-if="isAudio">
            <audio controls>
                <source :src="fileUrl" type="audio/mpeg" />
                <!-- You can add more source elements for different audio formats -->
            </audio>
        </template>
        <template v-else>
            <a
                :href="sanitizeUrl(fileUrl)"
                class="btn btn-light-warning"
                rel="noopener noreferrer"
                target="_blank">
                تحميل الملف
            </a>
        </template>
    </div>
</template>

<script>
import DOMPurify from 'dompurify';
export default {

    props: {
        fileUrl: {
            type: String,
            required: true,
        },
    },
    computed: {
        isImage() {
            return this.isFileType(['jpg', 'jpeg', 'png', 'gif', 'svg']);
        },
        isVideo() {
            return this.isFileType(['mp4', 'webm', 'ogg']);
        },
        isAudio() {
            return this.isFileType(['mp3', 'wav', 'ogg']);
        },
    },
    methods: {
        isFileType(allowedExtensions) {
            const extension = this.getFileExtension(this.fileUrl);
            return allowedExtensions.includes(extension);
        },
        getFileExtension(filename) {
            return filename.split('.').pop().toLowerCase();
        },
        sanitizeUrl(url) {
            return DOMPurify.sanitize(url);
        },
        isValidUrl(url) {
            const allowedProtocols = ['http:', 'https:'];
            const urlObject = new URL(url);
            return allowedProtocols.includes(urlObject.protocol);
        }
    },
};
</script>
