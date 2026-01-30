<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import {
    Plus,
    Trash2,
    Edit,
    ExternalLink,
    Folders,
    Search,
    Github
} from 'lucide-vue-next';
import Swal from 'sweetalert2';

const props = defineProps({
    projects: Array
});

const deleteProject = (id) => {
    Swal.fire({
        title: 'Are you sure?',
        text: "This project and its data will be permanently removed!",
        icon: 'warning',
        showCancelButton: true,
        background: '#0f172a',
        color: '#f8fafc',
        confirmButtonColor: '#e11d48',
        cancelButtonColor: '#334155',
        confirmButtonText: 'Delete Project',
        customClass: {
            container: 'font-sans',
            popup: 'rounded-[2rem] border border-slate-800',
            title: 'text-2xl font-black text-white',
            confirmButton: 'px-6 py-2.5 rounded-xl font-bold uppercase tracking-widest text-xs',
            cancelButton: 'px-6 py-2.5 rounded-xl font-bold uppercase tracking-widest text-xs'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            router.delete(route('admin.projects.destroy', id), {
                onSuccess: () => {
                    Swal.fire({
                        title: 'Success!',
                        text: 'Project has been removed successfully.',
                        icon: 'success',
                        background: '#0f172a',
                        color: '#f8fafc',
                        confirmButtonColor: '#0284c7',
                        customClass: {
                            popup: 'rounded-[2rem] border border-slate-800',
                        }
                    });
                }
            });
        }
    });
};
</script>

<template>

    <Head title="Manage Projects" />

    <AdminLayout>
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-12">
            <div>
                <h1 class="text-3xl font-black text-white">Project Library</h1>
                <p class="text-slate-400">Manage and showcase your best work.</p>
            </div>
            <Link :href="route('admin.projects.create')"
                class="flex items-center gap-2 px-6 py-3 bg-primary-600 hover:bg-primary-500 text-white rounded-2xl font-bold transition-all transform hover:-translate-y-1 shadow-lg shadow-primary-600/20">
                <Plus :size="20" />
                Add New Project
            </Link>
        </div>

        <!-- Filters/Search (Visual Only) -->
        <div class="flex flex-col md:flex-row gap-4 mb-8">
            <div class="relative flex-1">
                <Search class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-500" :size="20" />
                <input type="text" placeholder="Search projects by name or technology..."
                    class="w-full bg-slate-900/50 border border-slate-800 rounded-2xl pl-12 pr-6 py-4 text-white placeholder:text-slate-600 focus:outline-none focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500/50 transition-all font-medium" />
            </div>
        </div>

        <!-- Project Grid -->
        <div v-if="projects.length > 0" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <div v-for="project in projects" :key="project.id"
                class="bg-slate-900/50 border border-slate-800 rounded-[2.5rem] overflow-hidden group hover:border-primary-500/30 transition-all duration-500 flex flex-col">
                <!-- Thumbnail -->
                <div class="relative aspect-video overflow-hidden">
                    <img :src="project.image" :alt="project.title"
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" />
                    <div
                        class="absolute inset-0 bg-slate-950/60 opacity-0 group-hover:opacity-100 transition-all duration-500 flex items-center justify-center gap-4">
                        <Link :href="route('admin.projects.edit', project.id)"
                            class="w-12 h-12 bg-white text-slate-900 rounded-2xl flex items-center justify-center hover:bg-primary-500 hover:text-white transition-all shadow-xl scale-90 group-hover:scale-100 duration-500">
                            <Edit :size="20" />
                        </Link>
                        <button @click="deleteProject(project.id)"
                            class="w-12 h-12 bg-red-500/10 border border-red-500/20 text-red-500 rounded-2xl flex items-center justify-center hover:bg-red-500 hover:text-white transition-all shadow-xl scale-90 group-hover:scale-100 duration-500 delay-75">
                            <Trash2 :size="20" />
                        </button>
                    </div>
                    <div class="absolute top-4 left-4">
                        <span
                            class="px-3 py-1 bg-slate-900/80 backdrop-blur-md border border-slate-700 rounded-lg text-xs font-bold text-white uppercase tracking-widest">
                            #{{ project.order }}
                        </span>
                    </div>
                </div>

                <!-- Info -->
                <div class="p-8 flex-1 flex flex-col">
                    <div class="flex flex-wrap gap-2 mb-4">
                        <span v-for="tech in project.tech_stack" :key="tech"
                            class="text-[9px] uppercase font-black tracking-[0.15em] px-2.5 py-1 bg-primary-500/10 text-primary-400 border border-primary-500/10 rounded-lg">
                            {{ tech }}
                        </span>
                    </div>
                    <h3
                        class="text-xl font-bold text-white mb-3 group-hover:text-primary-400 transition-colors uppercase tracking-tight">
                        {{ project.title }}</h3>
                    <p class="text-slate-400 text-sm leading-relaxed line-clamp-2 mb-6">{{ project.description }}</p>

                    <div class="mt-auto pt-6 border-t border-slate-800/50 flex items-center justify-between">
                        <div class="flex gap-4">
                            <a v-if="project.github_url" :href="project.github_url" target="_blank"
                                class="text-slate-500 hover:text-white transition-colors">
                                <Github :size="18" />
                            </a>
                            <a v-if="project.live_url" :href="project.live_url" target="_blank"
                                class="text-slate-500 hover:text-primary-400 transition-colors">
                                <ExternalLink :size="18" />
                            </a>
                        </div>
                        <div
                            class="flex items-center gap-2 text-[10px] font-bold text-slate-600 uppercase tracking-widest">
                            <Folders :size="14" />
                            {{ project.gallery ? project.gallery.length : 0 }} Images
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Empty State -->
        <div v-else class="flex flex-col items-center justify-center py-24 text-center">
            <div
                class="w-24 h-24 bg-slate-900 border border-slate-800 rounded-[2rem] flex items-center justify-center text-slate-700 mb-8">
                <Folders :size="48" />
            </div>
            <h2 class="text-2xl font-black text-white mb-2">No Projects Found</h2>
            <p class="text-slate-400 max-w-sm mb-10">You haven't added any projects to your library yet. Start by
                creating your first masterpiece.</p>
            <Link :href="route('admin.projects.create')"
                class="px-10 py-4 bg-primary-600 hover:bg-primary-500 text-white rounded-2xl font-bold transition-all shadow-xl shadow-primary-600/20">
                Create My First Project
            </Link>
        </div>
    </AdminLayout>
</template>
