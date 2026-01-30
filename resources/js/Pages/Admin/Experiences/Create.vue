<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head, useForm, Link } from '@inertiajs/vue3';
import { ChevronLeft, Save, Briefcase, Calendar, MapPin, AlignLeft } from 'lucide-vue-next';

const form = useForm({
    job_title: '',
    company_name: '',
    employment_type: 'Full-time',
    start_date: '',
    end_date: '',
    is_current: false,
    location: '',
    description: '',
    order: 0,
});

const submit = () => {
    form.post(route('admin.experiences.store'));
};
</script>

<template>
    <AdminLayout>

        <Head title="Add Experience" />

        <div class="max-w-4xl mx-auto space-y-8 animate-fade-in">
            <!-- Header section -->
            <div class="flex items-center justify-between">
                <Link :href="route('admin.experiences.index')"
                    class="flex items-center gap-2 text-slate-400 hover:text-white transition-colors group">
                    <div
                        class="w-10 h-10 rounded-xl bg-slate-900 border border-slate-800 flex items-center justify-center group-hover:bg-slate-800 transition-all">
                        <ChevronLeft :size="20" />
                    </div>
                    <span class="font-bold">Back to Experiences</span>
                </Link>
            </div>

            <div class="bg-slate-900/50 border border-slate-800 rounded-[2.5rem] overflow-hidden">
                <div class="p-8 md:p-12 border-b border-slate-800 bg-gradient-to-br from-primary-600/5 to-transparent">
                    <h1 class="text-3xl font-black text-white tracking-tight">Add New <span
                            class="text-primary-500">Experience</span></h1>
                    <p class="text-slate-400 font-medium mt-1">Fill in the details of your professional role.</p>
                </div>

                <form @submit.prevent="submit" class="p-8 md:p-12 space-y-10">
                    <!-- Basic Info -->
                    <div class="grid md:grid-cols-2 gap-8">
                        <div class="space-y-2">
                            <label
                                class="flex items-center gap-2 text-sm font-black uppercase tracking-widest text-slate-400">
                                <Briefcase :size="14" class="text-primary-500" />
                                Job Title
                            </label>
                            <input v-model="form.job_title" type="text" placeholder="e.g. Laravel Developer"
                                class="w-full bg-slate-950 border border-slate-800 rounded-2xl px-6 py-4 text-white focus:outline-none focus:border-primary-500/50 transition-all placeholder:text-slate-700" />
                            <p v-if="form.errors.job_title" class="text-red-500 text-xs font-bold">{{
                                form.errors.job_title }}</p>
                        </div>

                        <div class="space-y-2">
                            <label
                                class="flex items-center gap-2 text-sm font-black uppercase tracking-widest text-slate-400">
                                <Link :size="14" class="text-primary-500 rotate-45" />
                                Company Name
                            </label>
                            <input v-model="form.company_name" type="text" placeholder="e.g. ALFASUN Software House"
                                class="w-full bg-slate-950 border border-slate-800 rounded-2xl px-6 py-4 text-white focus:outline-none focus:border-primary-500/50 transition-all placeholder:text-slate-700" />
                            <p v-if="form.errors.company_name" class="text-red-500 text-xs font-bold">{{
                                form.errors.company_name }}</p>
                        </div>
                    </div>

                    <!-- Employment Section -->
                    <div class="grid md:grid-cols-2 gap-8">
                        <div class="space-y-2">
                            <label
                                class="flex items-center gap-2 text-sm font-black uppercase tracking-widest text-slate-400">
                                <AlignLeft :size="14" class="text-primary-500" />
                                Employment Type
                            </label>
                            <select v-model="form.employment_type"
                                class="w-full bg-slate-950 border border-slate-800 rounded-2xl px-6 py-4 text-white focus:outline-none focus:border-primary-500/50 transition-all appearance-none">
                                <option value="Full-time">Full-time</option>
                                <option value="Part-time">Part-time</option>
                                <option value="Contract">Contract</option>
                                <option value="Internship">Internship</option>
                                <option value="Freelance">Freelance</option>
                            </select>
                            <p v-if="form.errors.employment_type" class="text-red-500 text-xs font-bold">{{
                                form.errors.employment_type }}</p>
                        </div>

                        <div class="space-y-2">
                            <label
                                class="flex items-center gap-2 text-sm font-black uppercase tracking-widest text-slate-400">
                                <MapPin :size="14" class="text-primary-500" />
                                Location
                            </label>
                            <input v-model="form.location" type="text" placeholder="e.g. Lahore, Pakistan or Remote"
                                class="w-full bg-slate-950 border border-slate-800 rounded-2xl px-6 py-4 text-white focus:outline-none focus:border-primary-500/50 transition-all placeholder:text-slate-700" />
                            <p v-if="form.errors.location" class="text-red-500 text-xs font-bold">{{
                                form.errors.location }}</p>
                        </div>
                    </div>

                    <!-- Dates Section -->
                    <div class="space-y-6">
                        <div class="flex items-center gap-4">
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <div class="relative">
                                    <input v-model="form.is_current" type="checkbox" class="sr-only peer">
                                    <div
                                        class="w-12 h-6 bg-slate-800 peer-checked:bg-primary-600 rounded-full transition-colors">
                                    </div>
                                    <div
                                        class="absolute left-1 top-1 w-4 h-4 bg-white rounded-full transition-transform peer-checked:translate-x-6">
                                    </div>
                                </div>
                                <span
                                    class="text-sm font-bold text-slate-200 group-hover:text-white transition-colors">I
                                    am currently working here</span>
                            </label>
                        </div>

                        <div class="grid md:grid-cols-2 gap-8">
                            <div class="space-y-2">
                                <label
                                    class="flex items-center gap-2 text-sm font-black uppercase tracking-widest text-slate-400">
                                    <Calendar :size="14" class="text-primary-500" />
                                    Start Date
                                </label>
                                <input v-model="form.start_date" type="date"
                                    class="w-full bg-slate-950 border border-slate-800 rounded-2xl px-6 py-4 text-white focus:outline-none focus:border-primary-500/50 transition-all" />
                                <p v-if="form.errors.start_date" class="text-red-500 text-xs font-bold">{{
                                    form.errors.start_date }}</p>
                            </div>

                            <div class="space-y-2">
                                <label
                                    class="flex items-center gap-2 text-sm font-black uppercase tracking-widest text-slate-400"
                                    :class="{ 'opacity-30': form.is_current }">
                                    <Calendar :size="14" class="text-primary-500" />
                                    End Date
                                </label>
                                <input v-model="form.end_date" type="date" :disabled="form.is_current"
                                    class="w-full bg-slate-950 border border-slate-800 rounded-2xl px-6 py-4 text-white focus:outline-none focus:border-primary-500/50 transition-all disabled:opacity-20 disabled:cursor-not-allowed" />
                                <p v-if="form.errors.end_date" class="text-red-500 text-xs font-bold">{{
                                    form.errors.end_date }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="space-y-2">
                        <label
                            class="flex items-center gap-2 text-sm font-black uppercase tracking-widest text-slate-400">
                            <AlignLeft :size="14" class="text-primary-500" />
                            Description / Responsibilities
                        </label>
                        <textarea v-model="form.description" rows="5" placeholder="What you did in this role..."
                            class="w-full bg-slate-950 border border-slate-800 rounded-2xl px-6 py-4 text-white focus:outline-none focus:border-primary-500/50 transition-all placeholder:text-slate-700 resize-none"></textarea>
                        <p v-if="form.errors.description" class="text-red-500 text-xs font-bold">{{
                            form.errors.description }}</p>
                    </div>

                    <!-- Footer -->
                    <div class="flex items-center justify-between pt-6 border-t border-slate-800">
                        <div class="space-y-2 max-w-xs">
                            <label class="text-xs font-black uppercase tracking-widest text-slate-500">Display
                                Order</label>
                            <input v-model="form.order" type="number"
                                class="w-24 bg-slate-950 border border-slate-800 rounded-xl px-4 py-2 text-white focus:outline-none focus:border-primary-500/50" />
                        </div>

                        <button type="submit" :disabled="form.processing"
                            class="inline-flex items-center gap-3 px-10 py-4 bg-primary-600 hover:bg-primary-500 disabled:opacity-50 disabled:cursor-not-allowed text-white font-black uppercase tracking-widest rounded-2xl transition-all shadow-xl shadow-primary-600/20">
                            <Save :size="20" />
                            {{ form.processing ? 'Saving...' : 'Save Experience' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </AdminLayout>
</template>
