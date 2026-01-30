<script setup>
import { ref } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';
import {
    LayoutDashboard,
    Layers,
    User,
    LogOut,
    Menu,
    X,
    FolderPlus,
    ExternalLink,
    ChevronRight,
    Briefcase,
    GraduationCap,
    MessageSquare
} from 'lucide-vue-next';

const isSidebarOpen = ref(true);
const page = usePage();

const navigation = [
    { name: 'Dashboard', href: route('admin.dashboard'), icon: LayoutDashboard, current: route().current('admin.dashboard') },
    { name: 'Projects', href: route('admin.projects.index'), icon: Layers, current: route().current('admin.projects.*') },
    { name: 'Experiences', href: route('admin.experiences.index'), icon: Briefcase, current: route().current('admin.experiences.*') },
    { name: 'Education', href: route('admin.education.index'), icon: GraduationCap, current: route().current('admin.education.*') },
    { name: 'Messages', href: route('admin.messages.index'), icon: MessageSquare, current: route().current('admin.messages.*') },
];

const toggleSidebar = () => {
    isSidebarOpen.value = !isSidebarOpen.value;
};
</script>

<template>
    <div class="min-h-screen bg-slate-950 text-slate-200 font-sans selection:bg-primary-500/30 flex">
        <!-- Sidebar -->
        <aside :class="[
            'fixed inset-y-0 left-0 z-50 w-72 bg-slate-900 border-r border-slate-800 transition-transform duration-300 ease-in-out lg:static lg:translate-x-0',
            isSidebarOpen ? 'translate-x-0' : '-translate-x-full'
        ]">
            <div class="flex flex-col h-full">
                <!-- Sidebar Header -->
                <div class="h-20 flex items-center justify-between px-8 border-b border-slate-800">
                    <Link :href="route('portfolio')"
                        class="text-2xl font-black bg-gradient-to-r from-primary-400 to-accent bg-clip-text text-transparent logo-font">
                        Shiekh
                    </Link>
                    <button @click="toggleSidebar" class="lg:hidden text-slate-400">
                        <X :size="20" />
                    </button>
                </div>

                <!-- Sidebar Content -->
                <nav class="flex-1 px-4 py-8 space-y-2 overflow-y-auto">
                    <Link v-for="item in navigation" :key="item.name" :href="item.href" :class="[
                        'group flex items-center justify-between px-4 py-3 rounded-2xl transition-all duration-300',
                        item.current
                            ? 'bg-primary-600/10 text-primary-400 border border-primary-500/20 shadow-lg shadow-primary-500/5'
                            : 'text-slate-400 hover:bg-slate-800 hover:text-slate-200 border border-transparent'
                    ]">
                        <div class="flex items-center gap-3">
                            <component :is="item.icon" :size="20"
                                :class="item.current ? 'text-primary-400' : 'text-slate-500 group-hover:text-slate-300'" />
                            <span class="font-bold">{{ item.name }}</span>
                        </div>
                        <ChevronRight v-if="item.current" :size="16" class="text-primary-400" />
                    </Link>
                </nav>

                <!-- Sidebar Footer -->
                <div class="p-6 border-t border-slate-800">
                    <div
                        class="flex items-center gap-3 px-4 py-3 mb-4 rounded-2xl bg-slate-800/50 border border-slate-700/50">
                        <div
                            class="w-10 h-10 rounded-full bg-primary-600 flex items-center justify-center font-bold text-white shadow-lg">
                            {{ $page.props.auth.user.name.charAt(0) }}
                        </div>
                        <div class="flex-1 overflow-hidden">
                            <p class="text-sm font-bold text-slate-200 truncate">{{ $page.props.auth.user.name }}</p>
                            <p class="text-xs text-slate-500 truncate">{{ $page.props.auth.user.email }}</p>
                        </div>
                    </div>
                    <Link :href="route('logout')" method="post" as="button"
                        class="w-full flex items-center gap-3 px-4 py-3 rounded-2xl text-slate-400 hover:bg-red-500/10 hover:text-red-400 transition-all duration-300 group">
                        <LogOut :size="20" class="group-hover:translate-x-1 transition-transform" />
                        <span class="font-bold">Logout</span>
                    </Link>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col min-w-0 overflow-hidden">
            <!-- Topbar -->
            <header
                class="h-20 bg-slate-900/50 backdrop-blur-md border-b border-slate-800 flex items-center justify-between px-8 sticky top-0 z-40">
                <button @click="toggleSidebar" class="p-2 bg-slate-800 rounded-xl text-slate-400 lg:hidden">
                    <Menu :size="20" />
                </button>
                <div class="flex items-center gap-6">
                    <a href="/" target="_blank"
                        class="hidden sm:flex items-center gap-2 text-sm font-bold text-slate-400 hover:text-primary-400 transition-colors">
                        View Site
                        <ExternalLink :size="14" />
                    </a>
                </div>
            </header>

            <!-- Content Area -->
            <main class="flex-1 overflow-y-auto p-8 lg:p-12">
                <div class="max-w-6xl mx-auto">
                    <slot />
                </div>
            </main>
        </div>
    </div>
</template>
