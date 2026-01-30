<script setup>
import { Head, Link } from '@inertiajs/vue3';
import {
    Github,
    ExternalLink,
    ChevronLeft,
    Calendar,
    Target,
    Layers,
    ArrowRight,
    X
} from 'lucide-vue-next';
import { onMounted, ref } from 'vue';

const props = defineProps({
    project: Object,
    nextProject: Object
});

const activeImage = ref(props.project.image);
const scrolled = ref(false);
const lightboxImage = ref(null);

const openLightbox = (img) => {
    lightboxImage.value = img;
    document.body.style.overflow = 'hidden';
};

const closeLightbox = () => {
    lightboxImage.value = null;
    document.body.style.overflow = 'auto';
};

const handleKeydown = (e) => {
    if (e.key === 'Escape' && lightboxImage.value) {
        closeLightbox();
    }
};

onMounted(() => {
    window.addEventListener('scroll', () => {
        scrolled.value = window.scrollY > 50;
    });
    window.addEventListener('keydown', handleKeydown);
});

import { onUnmounted } from 'vue';
onUnmounted(() => {
    window.removeEventListener('keydown', handleKeydown);
});
</script>

<template>

    <Head :title="project.title + ' - Project Detail'" />

    <div class="min-h-screen bg-[#050505] text-slate-300 selection:bg-primary-500 selection:text-white">
        <!-- Navigation -->
        <nav :class="[
            'fixed top-0 left-0 right-0 z-50 transition-all duration-500 px-6 py-4',
            scrolled ? 'bg-[#050505]/80 backdrop-blur-xl border-b border-white/5 py-4' : 'bg-transparent py-8'
        ]">
            <div class="container mx-auto flex justify-between items-center">
                <Link :href="route('portfolio')" class="flex items-center gap-2 group text-white">
                    <div
                        class="w-10 h-10 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center group-hover:bg-primary-500 group-hover:border-primary-500 transition-all duration-300">
                        <ChevronLeft :size="20" />
                    </div>
                    <span class="font-bold tracking-tight opacity-60 group-hover:opacity-100 transition-opacity">Back to
                        Portfolio</span>
                </Link>

                <div class="flex items-center gap-4">
                    <a v-if="project.github_url" :href="project.github_url" target="_blank"
                        class="w-10 h-10 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center hover:bg-white hover:text-black transition-all">
                        <Github :size="20" />
                    </a>
                    <a v-if="project.live_url" :href="project.live_url" target="_blank"
                        class="px-5 py-2.5 rounded-xl bg-primary-600 hover:bg-primary-500 text-white font-bold text-sm transition-all flex items-center gap-2 shadow-lg shadow-primary-600/20">
                        Launch Project
                        <ExternalLink :size="16" />
                    </a>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <header class="relative pt-32 pb-20 px-6 overflow-hidden">
            <div
                class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-[800px] bg-gradient-to-b from-primary-600/10 via-transparent to-transparent -z-10 blur-[120px]">
            </div>

            <div class="container mx-auto text-center">
                <div
                    class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/5 border border-white/10 text-xs font-black uppercase tracking-[0.2em] text-primary-400 mb-8 animate-fade-in">
                    <Layers :size="14" />
                    Case Study
                </div>
                <h1 class="text-5xl md:text-8xl font-black text-white mb-8 tracking-tighter leading-none animate-title">
                    {{ project.title }}
                </h1>

                <div class="flex flex-wrap justify-center gap-3 mb-16">
                    <span v-for="tech in project.tech_stack" :key="tech"
                        class="px-4 py-2 rounded-xl bg-white/5 border border-white/10 text-xs font-bold uppercase tracking-widest text-slate-400 whitespace-nowrap">
                        {{ tech }}
                    </span>
                </div>
            </div>
        </header>

        <!-- Content Section -->
        <section class="py-20 px-6">
            <div class="container mx-auto">
                <div class="grid lg:grid-cols-12 gap-16">
                    <!-- Sidebar -->
                    <div class="lg:col-span-4 space-y-12">
                        <div class="space-y-6">
                            <h3
                                class="text-sm font-black uppercase tracking-[0.2em] text-white flex items-center gap-3">
                                <div class="w-8 h-[1px] bg-primary-500"></div>
                                Project Intel
                            </h3>
                            <div class="space-y-6">
                                <div class="flex items-center gap-4 group">
                                    <div
                                        class="w-12 h-12 rounded-2xl bg-white/5 border border-white/10 flex items-center justify-center text-slate-500 group-hover:text-primary-400 group-hover:bg-primary-500/10 transition-all">
                                        <Calendar :size="20" />
                                    </div>
                                    <div>
                                        <p class="text-[10px] font-black uppercase tracking-widest text-slate-600 mb-1">
                                            Timeline</p>
                                        <p class="font-bold text-white">{{ new
                                            Date(project.created_at).toLocaleDateString('en-US', {
                                                month: 'long', year:
                                                    'numeric'
                                            }) }}</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-4 group">
                                    <div
                                        class="w-12 h-12 rounded-2xl bg-white/5 border border-white/10 flex items-center justify-center text-slate-500 group-hover:text-emerald-400 group-hover:bg-emerald-500/10 transition-all">
                                        <Target :size="20" />
                                    </div>
                                    <div>
                                        <p class="text-[10px] font-black uppercase tracking-widest text-slate-600 mb-1">
                                            Status</p>
                                        <p class="font-bold text-white">Completed</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div
                            class="p-8 rounded-[2rem] bg-gradient-to-br from-white/5 to-transparent border border-white/5">
                            <h4 class="text-lg font-bold text-white mb-4">Want to build something similar?</h4>
                            <p class="text-slate-400 text-sm mb-6 leading-relaxed">I'm currently available for new
                                projects and collaborations. Let's create something extraordinary.</p>
                            <Link :href="route('portfolio') + '#contact'"
                                class="inline-flex items-center gap-2 font-black text-xs uppercase tracking-widest text-primary-400 hover:text-white transition-colors">
                                Start Inquiry
                                <ArrowRight :size="16" />
                            </Link>
                        </div>
                    </div>

                    <!-- Main Content -->
                    <div class="lg:col-span-8">
                        <div class="space-y-12">
                            <div class="prose prose-invert max-w-none">
                                <h2 class="text-3xl font-black text-white mb-8">The Challenge & <span
                                        class="text-primary-500">Solution</span></h2>
                                <p class="text-xl text-slate-400 leading-relaxed mb-6">
                                    {{ project.description }}
                                </p>
                            </div>

                            <!-- Image Gallery -->
                            <div v-if="project.gallery && project.gallery.length > 0" class="space-y-8">
                                <h3
                                    class="text-sm font-black uppercase tracking-[0.2em] text-white flex items-center gap-3">
                                    <div class="w-8 h-[1px] bg-primary-500"></div>
                                    Visual Showcase
                                </h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div v-for="(img, index) in project.gallery" :key="index" @click="openLightbox(img)"
                                        class="group relative rounded-3xl overflow-hidden border border-white/5 cursor-pointer shadow-xl">
                                        <div
                                            class="absolute inset-0 bg-primary-600/20 opacity-0 group-hover:opacity-100 transition-opacity z-10 flex items-center justify-center">
                                            <span
                                                class="px-4 py-2 bg-white text-black font-black text-[10px] uppercase tracking-widest rounded-xl scale-90 group-hover:scale-100 transition-transform">View
                                                Large</span>
                                        </div>
                                        <img :src="img"
                                            class="w-full aspect-video object-cover transition-transform duration-700 group-hover:scale-110" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="py-20 border-t border-white/5 relative overflow-hidden">
            <div class="container mx-auto px-6 text-center">
                <Link :href="route('portfolio')"
                    class="group inline-flex items-center gap-4 px-8 py-4 bg-white/5 border border-white/10 rounded-2xl font-bold text-white hover:bg-white hover:text-black transition-all">
                    <ChevronLeft :size="20" />
                    Explore More Projects
                </Link>
            </div>
        </footer>

        <!-- Lightbox Modal -->
        <Transition name="fade">
            <div v-if="lightboxImage" @click.self="closeLightbox"
                class="fixed inset-0 z-[100] bg-black/95 backdrop-blur-xl flex items-center justify-center p-6 md:p-12 cursor-zoom-out">
                <button @click="closeLightbox"
                    class="absolute top-8 right-8 w-14 h-14 bg-white/10 hover:bg-primary-500 hover:scale-110 text-white rounded-full flex items-center justify-center transition-all duration-300 z-[110]"
                    title="Close (Esc)">
                    <X :size="32" />
                </button>
                <img :src="lightboxImage"
                    class="max-w-full max-h-full object-contain rounded-2xl shadow-2xl animate-zoom-in cursor-default"
                    alt="" />
            </div>
        </Transition>
    </div>
</template>

<style scoped>
@keyframes title-reveal {
    from {
        opacity: 0;
        transform: translateY(40px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-title {
    animation: title-reveal 1.2s cubic-bezier(0.16, 1, 0.3, 1) forwards;
}

.animate-fade-in {
    animation: opacity 1s ease forwards;
}

.animate-reveal {
    animation: reveal 1.5s cubic-bezier(0.16, 1, 0.3, 1) forwards;
}

@keyframes reveal {
    from {
        clip-path: inset(100% 0 0 0);
    }

    to {
        clip-path: inset(0 0 0 0);
    }
}

.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.5s ease;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}

@keyframes zoom-in {
    from {
        opacity: 0;
        transform: scale(0.9);
    }

    to {
        opacity: 1;
        transform: scale(1);
    }
}

.animate-zoom-in {
    animation: zoom-in 0.4s cubic-bezier(0.16, 1, 0.3, 1) forwards;
}
</style>
