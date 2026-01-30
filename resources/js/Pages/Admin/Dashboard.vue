<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import {
    Layers,
    MessageSquare,
    TrendingUp,
    ExternalLink,
    Plus
} from 'lucide-vue-next';

const props = defineProps({
    stats: Object,
    recentProjects: Array,
    recentMessages: Array
});

const dashboardStats = [
    { name: 'Total Projects', value: props.stats.projectsCount, icon: Layers, color: 'text-primary-400', bg: 'bg-primary-500/10' },
    { name: 'Contact Messages', value: props.stats.messagesCount, icon: MessageSquare, color: 'text-accent', bg: 'bg-accent/10' },
    { name: 'Visitor Reach', value: '1.2k', icon: TrendingUp, color: 'text-emerald-400', bg: 'bg-emerald-500/10' },
];
</script>

<template>

    <Head title="Admin Dashboard" />

    <AdminLayout>
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-12">
            <div>
                <h1 class="text-3xl font-black text-white mb-2">Welcome back, {{ $page.props.auth.user.name }}!</h1>
                <p class="text-slate-400">Here's what's happening with your portfolio today.</p>
            </div>
            <Link :href="route('admin.projects.create')"
                class="flex items-center gap-2 px-6 py-3 bg-primary-600 hover:bg-primary-500 text-white rounded-2xl font-bold transition-all transform hover:-translate-y-1 shadow-lg shadow-primary-600/20 shadow-xl">
                <Plus :size="20" />
                Add New Project
            </Link>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
            <div v-for="stat in dashboardStats" :key="stat.name"
                class="bg-slate-900/50 border border-slate-800 p-8 rounded-3xl hover:border-primary-500/30 transition-all group">
                <div
                    :class="[stat.bg, 'w-12 h-12 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform']">
                    <component :is="stat.icon" :class="stat.color" :size="24" />
                </div>
                <p class="text-slate-400 font-bold text-sm uppercase tracking-widest mb-1">{{ stat.name }}</p>
                <p class="text-4xl font-black text-white">{{ stat.value }}</p>
            </div>
        </div>

        <!-- Quick Actions / Recent Activity -->
        <div class="grid lg:grid-cols-2 gap-8">
            <div class="bg-slate-900/50 border border-slate-800 rounded-[2.5rem] p-8">
                <h3 class="text-xl font-bold text-white mb-6">Recent Projects</h3>
                <div class="space-y-4">
                    <div v-if="recentProjects.length > 0" v-for="project in recentProjects" :key="project.id"
                        class="p-4 bg-slate-800/30 rounded-2xl border border-slate-700/30 flex items-center justify-between">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-slate-700 rounded-xl overflow-hidden">
                                <img :src="project.image" class="w-full h-full object-cover" alt="" />
                            </div>
                            <div>
                                <p class="font-bold text-white">{{ project.title }}</p>
                                <p class="text-xs text-slate-500">Added {{ new
                                    Date(project.created_at).toLocaleDateString() }}</p>
                            </div>
                        </div>
                        <Link :href="route('admin.projects.edit', project.id)"
                            class="text-slate-400 hover:text-primary-400">
                            <ExternalLink :size="16" />
                        </Link>
                    </div>
                    <div v-else class="text-center py-10">
                        <p class="text-slate-500 font-bold italic">No projects added yet.</p>
                    </div>
                </div>
                <Link :href="route('admin.projects.index')"
                    class="mt-8 w-full flex items-center justify-center gap-2 px-6 py-4 bg-slate-800 hover:bg-slate-700 text-slate-300 rounded-2xl font-bold transition-all">
                    View All Projects
                </Link>
            </div>

            <div class="bg-slate-900/50 border border-slate-800 rounded-[2.5rem] p-8">
                <h3 class="text-xl font-bold text-white mb-6">Latest Messages</h3>
                <div class="space-y-4">
                    <div v-if="recentMessages.length > 0" v-for="message in recentMessages" :key="message.id"
                        class="p-4 bg-slate-800/30 rounded-2xl border border-slate-700/30">
                        <div class="flex items-center justify-between mb-2">
                            <span class="font-bold text-white text-sm">{{ message.name }}</span>
                            <span class="text-[10px] text-slate-500 uppercase tracking-widest">{{ new
                                Date(message.created_at).toLocaleDateString() }}</span>
                        </div>
                        <p class="text-xs text-slate-400 line-clamp-1 italic">"{{ message.message }}"</p>
                    </div>
                    <div v-else class="flex flex-col items-center justify-center h-48 text-center">
                        <div
                            class="w-16 h-16 bg-slate-800 rounded-full flex items-center justify-center mb-4 text-slate-600">
                            <MessageSquare :size="32" />
                        </div>
                        <p class="text-slate-400 font-medium">No new messages yet.</p>
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
