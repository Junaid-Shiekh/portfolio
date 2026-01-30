<script setup>
import { ref, onMounted } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import {
    Github,
    Linkedin,
    Twitter,
    Instagram,
    Menu,
    X,
    GraduationCap,
    Calendar,
    BookOpen,
    MapPin,
    Home,
    MessageSquare,
    ExternalLink
} from 'lucide-vue-next';

const props = defineProps({
    educations: Array,
});

const isMenuOpen = ref(false);
const scrolled = ref(false);

onMounted(() => {
    window.addEventListener('scroll', () => {
        scrolled.value = window.scrollY > 50;
    });
});
</script>

<template>
    <div class="min-h-screen bg-slate-950 text-slate-200 font-sans selection:bg-primary-500/30">

        <Head title="Education | Shiekh Portfolio" />

        <!-- Header -->
        <header :class="[
            'fixed top-0 w-full z-50 transition-all duration-300 border-b',
            scrolled ? 'bg-slate-950/80 backdrop-blur-md border-slate-800 py-3' : 'bg-transparent border-transparent py-5'
        ]">
            <div class="container mx-auto px-6 flex justify-between items-center">
                <Link :href="route('portfolio')"
                    class="text-3xl font-bold bg-gradient-to-r from-primary-400 to-accent bg-clip-text text-transparent logo-font">
                    Junaid Shiekh
                </Link>

                <!-- Desktop Nav -->
                <nav class="hidden md:flex items-center space-x-8">
                    <Link :href="route('portfolio')" class="hover:text-primary-400 transition-colors">Home</Link>
                    <Link :href="route('education')"
                        class="text-primary-400 font-bold border-b-2 border-primary-400 pb-1">Education</Link>
                    <Link :href="route('portfolio') + '#projects'" class="hover:text-primary-400 transition-colors">
                        Projects</Link>
                    <Link :href="route('portfolio') + '#experience'" class="hover:text-primary-400 transition-colors">
                        Experience</Link>
                    <Link :href="route('portfolio') + '#contact'"
                        class="px-5 py-2 bg-primary-600 hover:bg-primary-500 text-white rounded-full transition-all shadow-lg shadow-primary-600/20">
                        Hire Me
                    </Link>
                </nav>

                <!-- Mobile Nav Toggle -->
                <button class="md:hidden text-slate-200" @click="isMenuOpen = !isMenuOpen">
                    <Menu v-if="!isMenuOpen" />
                    <X v-else />
                </button>
            </div>

            <!-- Mobile Drawer -->
            <transition enter-active-class="transition duration-500 cubic-bezier(0.16, 1, 0.3, 1)"
                enter-from-class="translate-x-full" enter-to-class="translate-x-0"
                leave-active-class="transition duration-400 ease-in" leave-from-class="translate-x-0"
                leave-to-class="translate-x-full">
                <div v-if="isMenuOpen" class="fixed inset-0 z-50 md:hidden overflow-hidden">
                    <div class="absolute inset-0 bg-slate-950/60 backdrop-blur-md" @click="isMenuOpen = false"></div>
                    <div
                        class="absolute top-0 right-0 w-3/4 h-full bg-slate-900 border-l border-slate-800 flex flex-col p-8 rounded-l-[2.5rem]">
                        <div class="flex justify-between items-center mb-10">
                            <div
                                class="text-2xl font-black bg-gradient-to-r from-primary-400 to-accent bg-clip-text text-transparent logo-font">
                                Junaid Shiekh</div>
                            <button @click="isMenuOpen = false" class="p-2 bg-slate-800/50 rounded-xl text-slate-400">
                                <X :size="20" />
                            </button>
                        </div>
                        <div class="flex flex-col space-y-5">
                            <Link :href="route('portfolio')"
                                class="text-lg font-bold text-slate-300 hover:text-primary-400">Home</Link>
                            <Link :href="route('education')" class="text-lg font-bold text-primary-400">Education</Link>
                            <Link :href="route('portfolio') + '#projects'" class="text-lg font-bold text-slate-300">
                                Projects</Link>
                            <Link :href="route('portfolio') + '#experience'" class="text-lg font-bold text-slate-300">
                                Experience</Link>
                            <div class="pt-4">
                                <Link :href="route('portfolio') + '#contact'"
                                    class="w-full inline-block text-center px-6 py-3 bg-gradient-to-r from-primary-600 to-primary-500 text-white rounded-xl font-bold shadow-lg">
                                    Hire Me
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>
            </transition>
        </header>

        <main class="pt-32 pb-24">
            <!-- Hero Section -->
            <section class="container mx-auto px-6 mb-20 relative">
                <div
                    class="absolute -top-24 -left-24 w-96 h-96 bg-primary-600/10 rounded-full blur-[100px] animate-pulse">
                </div>

                <div class="max-w-4xl mx-auto flex flex-col items-center text-center md:items-start md:text-left">
                    <div
                        class="inline-flex items-center gap-2 px-4 py-2 bg-primary-500/10 border border-primary-500/20 rounded-full text-primary-400 text-sm font-bold mb-6 animate__animated animate__zoomIn">
                        <GraduationCap :size="16" />
                        Academic Journey
                    </div>
                    <h1
                        class="text-4xl md:text-6xl lg:text-7xl font-black text-white leading-tight mb-8 animate__animated animate__fadeInDown">
                        My <span
                            class="text-transparent bg-clip-text bg-gradient-to-r from-primary-400 to-accent">Education</span>
                        Background
                    </h1>
                    <p
                        class="text-lg md:text-xl text-slate-400 leading-relaxed max-w-2xl animate__animated animate__fadeInUp animate__delay-1s">
                        My academic journey has been a blend of rigorous theoretical learning and hands-on technological
                        exploration, shaping my path as a Full Stack Developer.
                    </p>
                </div>
            </section>

            <!-- Education Timeline -->
            <section class="container mx-auto px-6">
                <div v-if="educations.length > 0" class="max-w-5xl mx-auto space-y-12">
                    <div v-for="(edu, idx) in educations" :key="edu.id" class="group relative pl-0 md:pl-24"
                        :class="['animate__animated animate__fadeInUp']"
                        :style="{ animationDelay: (idx * 200) + 'ms' }">

                        <!-- Timeline line for desktop -->
                        <div
                            class="hidden md:block absolute left-10 top-0 bottom-0 w-px bg-slate-800 group-last:bg-transparent">
                        </div>
                        <div class="hidden md:flex absolute left-0 top-0 w-20 items-center justify-center">
                            <div
                                class="w-4 h-4 rounded-full bg-primary-500 ring-8 ring-primary-500/10 group-hover:ring-primary-500/30 transition-all duration-500">
                            </div>
                        </div>

                        <div
                            class="bg-slate-900/40 border border-slate-800 rounded-[2.5rem] p-8 md:p-12 hover:border-primary-500/30 transition-all duration-500 group-hover:-translate-y-2 shadow-xl hover:shadow-primary-500/5 relative overflow-hidden">
                            <!-- Background Accent -->
                            <div
                                class="absolute -right-10 -top-10 w-40 h-40 bg-primary-600/5 rounded-full blur-[40px] group-hover:bg-primary-600/10 transition-colors">
                            </div>

                            <div
                                class="flex flex-col lg:flex-row lg:items-center justify-between gap-8 relative z-10 text-center md:text-left">
                                <div
                                    class="space-y-4 flex flex-col items-center md:items-start text-center md:text-left">
                                    <div class="flex flex-wrap items-center justify-center md:justify-start gap-3">
                                        <span
                                            class="px-3 py-1 bg-slate-800 text-slate-400 text-xs font-bold rounded-full border border-slate-700">
                                            {{ edu.start_date }} - {{ edu.is_current ? 'Present' : edu.end_date }}
                                        </span>
                                        <span v-if="edu.cgpa"
                                            class="px-3 py-1 bg-emerald-500/10 text-emerald-400 text-xs font-bold rounded-full border border-emerald-500/20 flex items-center gap-1.5">
                                            <BookOpen :size="12" />
                                            CGPA: {{ edu.cgpa }}
                                        </span>
                                    </div>

                                    <h2
                                        class="text-2xl md:text-4xl font-black text-white group-hover:text-primary-400 transition-colors">
                                        {{ edu.degree }}
                                    </h2>

                                    <div
                                        class="flex flex-col sm:flex-row sm:items-center justify-center md:justify-start gap-2 sm:gap-4 text-slate-400 font-medium">
                                        <div class="flex items-center gap-2">
                                            <div
                                                class="w-8 h-8 rounded-lg bg-slate-800 flex items-center justify-center text-primary-400">
                                                <Home :size="16" />
                                            </div>
                                            {{ edu.institution }}
                                        </div>
                                        <div class="hidden sm:block w-1.5 h-1.5 rounded-full bg-slate-800"></div>
                                        <div class="flex items-center gap-2">
                                            <div
                                                class="w-8 h-8 rounded-lg bg-slate-800 flex items-center justify-center text-accent">
                                                <BookOpen :size="16" />
                                            </div>
                                            {{ edu.field_of_study }}
                                        </div>
                                    </div>
                                </div>

                                <div class="hidden lg:block shrink-0">
                                    <div
                                        class="w-20 h-20 rounded-3xl bg-slate-800 flex items-center justify-center text-slate-600 group-hover:text-primary-400 group-hover:bg-primary-500/10 transition-all duration-500">
                                        <GraduationCap :size="40" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Empty State -->
                <div v-else
                    class="text-center py-24 bg-slate-900/40 border border-slate-800 border-dashed rounded-[3rem]">
                    <div
                        class="w-20 h-20 rounded-3xl bg-slate-800 flex items-center justify-center text-slate-600 mx-auto mb-6">
                        <GraduationCap :size="40" />
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-2">Academic history coming soon</h3>
                    <p class="text-slate-400 max-w-sm mx-auto">The academic journey is currently being updated. Please
                        check back later!</p>
                </div>
            </section>
        </main>

        <!-- Footer -->
        <footer class="py-12 border-t border-slate-800">
            <div class="container mx-auto px-6 flex flex-col md:flex-row justify-between items-center gap-8">
                <Link :href="route('portfolio')"
                    class="text-3xl font-bold bg-gradient-to-r from-primary-400 to-accent bg-clip-text text-transparent logo-font">
                    Junaid Shiekh
                </Link>
                <div class="text-slate-500 text-sm">
                    © 2026 Junaid Shiekh. Crafted with Laravel & Vue 3. All rights reserved.
                </div>
                <div class="flex items-center space-x-6 text-slate-400">
                    <a href="https://github.com/Junaid-Shiekh" target="_blank"
                        class="hover:text-primary-400 transition-colors">
                        <Github :size="20" />
                    </a>
                    <a href="#" class="hover:text-primary-400 transition-colors">
                        <Linkedin :size="20" />
                    </a>
                    <a href="#" class="hover:text-primary-400 transition-colors">
                        <Twitter :size="20" />
                    </a>
                </div>
            </div>
        </footer>
    </div>
</template>

<style>
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-fade-in-up {
    animation: fadeInUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
}
</style>
