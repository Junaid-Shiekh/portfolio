<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head, useForm, Link } from '@inertiajs/vue3';
import { ref } from 'vue';
import {
    Upload,
    X,
    Plus,
    ChevronLeft,
    Save,
    Image as ImageIcon
} from 'lucide-vue-next';

const mainImagePreview = ref(null);
const galleryPreviews = ref([]);

const techOptions = [
    'Laravel', 'Vue.js', 'React', 'Node.js', 'Inertia.js',
    'Tailwind CSS', 'Bootstrap', 'MySQL', 'PostgreSQL',
    'Redis', 'Docker', 'AWS', 'Firebase'
];

const form = useForm({
    title: '',
    description: '',
    image: null,
    tech_stack: [],
    live_url: '',
    github_url: '',
    order: 0,
    gallery: []
});

const handleMainImageChange = (e) => {
    const file = e.target.files[0];
    if (file) {
        form.image = file;
        mainImagePreview.value = URL.createObjectURL(file);
    }
};

const handleGalleryChange = (e) => {
    const files = Array.from(e.target.files);
    files.forEach(file => {
        form.gallery.push(file);
        galleryPreviews.value.push(URL.createObjectURL(file));
    });
};

const removeGalleryItem = (index) => {
    form.gallery.splice(index, 1);
    galleryPreviews.value.splice(index, 1);
};

const toggleTech = (tech) => {
    const index = form.tech_stack.indexOf(tech);
    if (index === -1) {
        form.tech_stack.push(tech);
    } else {
        form.tech_stack.splice(index, 1);
    }
};

const submit = () => {
    form.post(route('admin.projects.store'), {
        forceFormData: true,
        onSuccess: () => form.reset()
    });
};
</script>

<template>

    <Head title="Add New Project" />

    <AdminLayout>
        <!-- Header -->
        <div class="flex items-center gap-4 mb-10">
            <Link :href="route('admin.projects.index')"
                class="w-10 h-10 bg-slate-800 rounded-xl flex items-center justify-center text-slate-400 hover:bg-slate-700 hover:text-white transition-all">
                <ChevronLeft :size="20" />
            </Link>
            <div>
                <h1 class="text-3xl font-black text-white">Add New Project</h1>
                <p class="text-slate-400">Share your latest masterpiece with the world.</p>
            </div>
        </div>

        <form @submit.prevent="submit" class="grid lg:grid-cols-3 gap-8">
            <!-- Left Column: Form Details -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Basic Info -->
                <div class="bg-slate-900/50 border border-slate-800 rounded-[2.5rem] p-8 md:p-10 space-y-6">
                    <div class="space-y-4">
                        <label class="block text-sm font-bold text-slate-400 uppercase tracking-widest ml-1">Project
                            Title</label>
                        <input v-model="form.title" type="text" placeholder="e.g. E-commerce Dashboard"
                            class="w-full bg-slate-950/50 border border-slate-800 rounded-2xl px-6 py-4 text-white placeholder:text-slate-600 focus:outline-none focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500/50 transition-all font-medium" />
                        <div v-if="form.errors.title" class="text-red-400 text-sm mt-1 ml-1">{{ form.errors.title }}
                        </div>
                    </div>

                    <div class="space-y-4">
                        <label
                            class="block text-sm font-bold text-slate-400 uppercase tracking-widest ml-1">Description</label>
                        <textarea v-model="form.description" rows="6"
                            placeholder="Describe the project goals, challenges, and solutions..."
                            class="w-full bg-slate-950/50 border border-slate-800 rounded-2xl px-6 py-4 text-white placeholder:text-slate-600 focus:outline-none focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500/50 transition-all resize-none font-medium"></textarea>
                        <div v-if="form.errors.description" class="text-red-400 text-sm mt-1 ml-1">{{
                            form.errors.description }}</div>
                    </div>

                    <!-- Tech Stack MultiSelect -->
                    <div class="space-y-4">
                        <label
                            class="block text-sm font-bold text-slate-400 uppercase tracking-widest ml-1">Technologies
                            Used</label>
                        <div class="flex flex-wrap gap-2">
                            <button v-for="tech in techOptions" :key="tech" type="button" @click="toggleTech(tech)"
                                :class="[
                                    'px-4 py-2 rounded-xl text-xs font-bold uppercase tracking-wider transition-all border',
                                    form.tech_stack.includes(tech)
                                        ? 'bg-primary-600 border-primary-500 text-white shadow-lg shadow-primary-600/20'
                                        : 'bg-slate-800/50 border-slate-700/50 text-slate-400 hover:border-slate-600'
                                ]">
                                {{ tech }}
                            </button>
                        </div>
                        <div v-if="form.errors.tech_stack" class="text-red-400 text-sm mt-1 ml-1">{{
                            form.errors.tech_stack }}</div>
                    </div>
                </div>

                <!-- URLs -->
                <div class="bg-slate-900/50 border border-slate-800 rounded-[2.5rem] p-8 md:p-10">
                    <div class="grid md:grid-cols-2 gap-6">
                        <div class="space-y-4">
                            <label class="block text-sm font-bold text-slate-400 uppercase tracking-widest ml-1">Live
                                Demo URL</label>
                            <input v-model="form.live_url" type="url" placeholder="https://..."
                                class="w-full bg-slate-950/50 border border-slate-800 rounded-2xl px-6 py-4 text-white placeholder:text-slate-600 focus:outline-none focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500/50 transition-all font-medium" />
                        </div>
                        <div class="space-y-4">
                            <label class="block text-sm font-bold text-slate-400 uppercase tracking-widest ml-1">GitHub
                                Repo URL</label>
                            <input v-model="form.github_url" type="url" placeholder="https://github.com/..."
                                class="w-full bg-slate-950/50 border border-slate-800 rounded-2xl px-6 py-4 text-white placeholder:text-slate-600 focus:outline-none focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500/50 transition-all font-medium" />
                        </div>
                    </div>
                </div>

                <!-- Project Gallery -->
                <div class="bg-slate-900/50 border border-slate-800 rounded-[2.5rem] p-8 md:p-10 space-y-6">
                    <label class="block text-sm font-bold text-slate-400 uppercase tracking-widest ml-1">Project
                        Gallery</label>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <div v-for="(preview, index) in galleryPreviews" :key="index"
                            class="relative aspect-video rounded-2xl overflow-hidden border border-slate-700 bg-slate-950 group">
                            <img :src="preview" class="w-full h-full object-cover" alt="" />
                            <button @click="removeGalleryItem(index)" type="button"
                                class="absolute top-2 right-2 p-1.5 bg-red-500 text-white rounded-lg opacity-0 group-hover:opacity-100 transition-opacity">
                                <X :size="14" />
                            </button>
                        </div>
                        <label for="gallery-upload"
                            class="aspect-video rounded-2xl border-2 border-dashed border-slate-800 hover:border-primary-500/50 hover:bg-primary-500/5 transition-all flex flex-col items-center justify-center cursor-pointer text-slate-500 hover:text-primary-400 group">
                            <input id="gallery-upload" type="file" multiple class="hidden"
                                @change="handleGalleryChange" />
                            <Plus :size="24" class="mb-2 group-hover:scale-110 transition-transform" />
                            <span class="text-xs font-bold uppercase tracking-wider">Add Images</span>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Right Column: Sidebar Actions -->
            <div class="space-y-6">
                <!-- Thumbnail Upload -->
                <div class="bg-slate-900/50 border border-slate-800 rounded-[2.5rem] p-8 space-y-6 sticky top-32">
                    <label class="block text-sm font-bold text-slate-400 uppercase tracking-widest ml-1">Main
                        Thumbnail</label>
                    <div
                        class="relative aspect-[4/3] rounded-3xl overflow-hidden border-2 border-dashed border-slate-800 bg-slate-950 hover:border-primary-500/50 transition-all group">
                        <template v-if="mainImagePreview">
                            <img :src="mainImagePreview" class="w-full h-full object-cover" alt="" />
                            <div
                                class="absolute inset-0 bg-slate-950/60 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                <label for="main-thumbnail"
                                    class="cursor-pointer px-4 py-2 bg-white text-slate-900 rounded-xl font-bold text-sm">Change
                                    Image</label>
                            </div>
                        </template>
                        <label v-else for="main-thumbnail"
                            class="absolute inset-0 flex flex-col items-center justify-center cursor-pointer text-slate-600 hover:text-primary-400 transition-colors">
                            <Upload :size="40" class="mb-4 group-hover:scale-110 transition-transform" />
                            <span class="text-sm font-bold uppercase tracking-widest">Upload Header</span>
                        </label>
                        <input id="main-thumbnail" type="file" class="hidden" @change="handleMainImageChange" />
                    </div>
                    <div v-if="form.errors.image" class="text-red-400 text-sm mt-1 ml-1">{{ form.errors.image }}</div>

                    <div class="pt-4 space-y-4">
                        <div class="flex items-center justify-between text-sm px-1">
                            <span class="text-slate-500 font-bold uppercase tracking-wider">Order Position</span>
                            <input v-model="form.order" type="number"
                                class="w-20 bg-slate-800 border-none rounded-lg px-3 py-1 text-center font-bold text-white focus:ring-1 focus:ring-primary-500" />
                        </div>
                        <button type="submit" :disabled="form.processing"
                            class="w-full flex items-center justify-center gap-3 px-8 py-5 bg-gradient-to-r from-primary-600 to-primary-500 hover:from-primary-500 hover:to-primary-400 text-white rounded-[1.5rem] font-black text-lg transition-all transform hover:-translate-y-1 shadow-2xl shadow-primary-600/25 active:scale-95 disabled:opacity-50">
                            <Save v-if="!form.processing" :size="20" />
                            <span>{{ form.processing ? 'Uploading...' : 'Publish Project' }}</span>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </AdminLayout>
</template>
