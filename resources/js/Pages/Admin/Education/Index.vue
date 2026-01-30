<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import { GraduationCap, Plus, Pencil, Trash2, Calendar, BookOpen } from 'lucide-vue-next';
import Swal from 'sweetalert2';

defineProps({
    educations: Array
});

const deleteEducation = (id) => {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        background: '#0f172a',
        color: '#f8fafc',
        confirmButtonColor: '#e11d48',
        cancelButtonColor: '#334155',
        confirmButtonText: 'Yes, delete it!',
        customClass: {
            container: 'font-sans',
            popup: 'rounded-[2rem] border border-slate-800',
            title: 'text-2xl font-black text-white',
            confirmButton: 'px-6 py-2.5 rounded-xl font-bold uppercase tracking-widest text-xs',
            cancelButton: 'px-6 py-2.5 rounded-xl font-bold uppercase tracking-widest text-xs'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            router.delete(route('admin.education.destroy', id), {
                onSuccess: () => {
                    Swal.fire({
                        title: 'Deleted!',
                        text: 'Your education entry has been deleted.',
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
    <AdminLayout>

        <Head title="Manage Education" />

        <div class="space-y-8 animate-fade-in">
            <!-- Header section -->
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <h1 class="text-4xl font-black text-white tracking-tight mb-2">Education</h1>
                    <p class="text-slate-400 font-medium">Manage your academic background and qualifications.</p>
                </div>
                <Link :href="route('admin.education.create')"
                    class="inline-flex items-center gap-2 px-6 py-3 bg-primary-600 hover:bg-primary-500 text-white font-bold rounded-2xl transition-all shadow-lg shadow-primary-600/20 group">
                    <Plus :size="20" class="group-hover:rotate-90 transition-transform" />
                    Add Education
                </Link>
            </div>

            <!-- List section -->
            <div v-if="educations.length > 0" class="grid gap-6">
                <div v-for="edu in educations" :key="edu.id"
                    class="group bg-slate-900/50 border border-slate-800 rounded-3xl p-6 hover:border-primary-500/30 transition-all duration-300">
                    <div class="flex flex-col md:flex-row md:items-start justify-between gap-6">
                        <div class="flex gap-5">
                            <div
                                class="w-14 h-14 rounded-2xl bg-primary-600/10 border border-primary-500/20 flex items-center justify-center text-primary-400 shrink-0">
                                <GraduationCap :size="24" />
                            </div>
                            <div class="space-y-1">
                                <h3 class="text-xl font-bold text-white group-hover:text-primary-400 transition-colors">
                                    {{ edu.degree }}</h3>
                                <p class="text-primary-500 font-bold">{{ edu.institution }} <span
                                        class="text-slate-600 px-2">•</span> <span
                                        class="text-slate-400 text-sm font-medium">{{ edu.field_of_study }}</span></p>

                                <div class="flex flex-wrap items-center gap-4 mt-3 text-sm text-slate-500">
                                    <div class="flex items-center gap-1.5">
                                        <Calendar :size="14" />
                                        {{ edu.start_date }} - {{ edu.is_current ? 'Present' : edu.end_date }}
                                    </div>
                                    <div v-if="edu.cgpa" class="flex items-center gap-1.5">
                                        <BookOpen :size="14" />
                                        CGPA: {{ edu.cgpa }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center gap-2 md:self-center">
                            <Link :href="route('admin.education.edit', edu.id)"
                                class="p-3 bg-slate-800 hover:bg-primary-600 text-slate-400 hover:text-white rounded-xl transition-all"
                                title="Edit">
                                <Pencil :size="18" />
                            </Link>
                            <button @click="deleteEducation(edu.id)"
                                class="p-3 bg-slate-800 hover:bg-red-600 text-slate-400 hover:text-white rounded-xl transition-all"
                                title="Delete">
                                <Trash2 :size="18" />
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Empty state -->
            <div v-else class="bg-slate-900/50 border border-slate-800 border-dashed rounded-[2.5rem] p-16 text-center">
                <div
                    class="w-20 h-20 rounded-3xl bg-slate-800 flex items-center justify-center text-slate-600 mx-auto mb-6">
                    <GraduationCap :size="40" />
                </div>
                <h3 class="text-xl font-bold text-white mb-2">No education history added yet</h3>
                <p class="text-slate-500 mb-8 max-w-sm mx-auto">Start building your academic profile by adding your
                    first degree.</p>
                <Link :href="route('admin.education.create')"
                    class="inline-flex items-center gap-2 px-6 py-3 bg-white text-black font-bold rounded-2xl hover:bg-primary-500 hover:text-white transition-all">
                    <Plus :size="20" />
                    Add Education
                </Link>
            </div>
        </div>
    </AdminLayout>
</template>
