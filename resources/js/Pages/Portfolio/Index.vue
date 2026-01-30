<script setup>
import { ref, onMounted } from 'vue';
import { Head, useForm, Link } from '@inertiajs/vue3';
import {
    Github,
    Linkedin,
    Mail,
    MessageSquare,
    ExternalLink,
    Code,
    Database,
    Layers,
    Cpu,
    CheckCircle2,
    Menu,
    X,
    ChevronDown,
    Send,
    Instagram,
    Twitter,
    MapPin
} from 'lucide-vue-next';
import Swal from 'sweetalert2';

const props = defineProps({
    projects: Array,
    experiences: Array,
});

const form = useForm({
    name: '',
    email: '',
    message: '',
});

const isMenuOpen = ref(false);
const scrolled = ref(false);

const submit = () => {
    form.post(route('contact.store'), {
        preserveScroll: true,
        onSuccess: () => {
            form.reset();
            Swal.fire({
                title: 'Message Sent!',
                text: 'Thank you for reaching out. I will get back to you soon!',
                icon: 'success',
                background: '#0f172a',
                color: '#f8fafc',
                confirmButtonColor: '#0284c7',
                showClass: {
                    popup: 'animate__animated animate__fadeInDown'
                },
                hideClass: {
                    popup: 'animate__animated animate__fadeOutUp'
                },
                customClass: {
                    container: 'font-sans',
                    popup: 'rounded-[2.5rem] border border-slate-800',
                    title: 'text-2xl font-black tracking-tight',
                    confirmButton: 'px-8 py-3 rounded-2xl font-bold uppercase tracking-widest text-sm shadow-xl shadow-primary-500/20 transition-all'
                }
            });
        },
    });
};

onMounted(() => {
    window.addEventListener('scroll', () => {
        scrolled.value = window.scrollY > 50;
    });
});

const scrollTo = (id) => {
    const el = document.getElementById(id);
    if (el) {
        el.scrollIntoView({ behavior: 'smooth' });
        isMenuOpen.value = false;
    }
};

const skillsData = [
    {
        category: 'frontend',
        icon: Code,
        items: [
            { name: 'Vue.js', icon: 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/vuejs/vuejs-original.svg' },
            { name: 'Tailwind', icon: 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/tailwindcss/tailwindcss-original.svg' },
            { name: 'JavaScript', icon: 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/javascript/javascript-original.svg' },
            { name: 'Bootstrap', icon: 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/bootstrap/bootstrap-original.svg' },
        ]
    },
    {
        category: 'backend',
        icon: Layers,
        items: [
            { name: 'Laravel', icon: 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/laravel/laravel-original.svg' },
            { name: 'PHP', icon: 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/php/php-original.svg' },
            { name: 'Node.js', icon: 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/nodejs/nodejs-original.svg' },
        ]
    },
    {
        category: 'database',
        icon: Database,
        items: [
            { name: 'MySQL', icon: 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/mysql/mysql-original.svg' },
            { name: 'PostgreSQL', icon: 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/postgresql/postgresql-original.svg' },
            { name: 'Redis', icon: 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/redis/redis-original.svg' },
        ]
    },
    {
        category: 'tools',
        icon: Cpu,
        items: [
            { name: 'Docker', icon: 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/docker/docker-original.svg' },
            { name: 'Git', icon: 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/git/git-original.svg' },
            { name: 'Postman', icon: 'https://raw.githubusercontent.com/postmanlabs/postman-docs/develop/assets/postman-logo-mark.svg' },
            { name: 'Figma', icon: 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/figma/figma-original.svg' },
        ]
    }
];

const services = [
    {
        title: 'Laravel Web Development',
        description: 'Building robust, scalable, and secure backends using the latest Laravel features.',
        icon: Layers
    },
    {
        title: 'Full Stack Web Apps',
        description: 'End-to-end development of modern web applications with Vue.js and Inertia.js.',
        icon: Code
    },
    {
        title: 'Admin Dashboards',
        description: 'Custom, data-driven dashboards with real-time analytics and management tools.',
        icon: Cpu
    },
    {
        title: 'API Development',
        description: 'Designing and implementing clean, performant, and well-documented RESTful APIs.',
        icon: Database
    }
];



</script>

<template>
    <div class="min-h-screen bg-slate-950 text-slate-200 font-sans selection:bg-primary-500/30">

        <Head title="Full Stack Developer | Portfolio" />

        <!-- Header -->
        <header :class="[
            'fixed top-0 w-full z-50 transition-all duration-300 border-b',
            scrolled ? 'bg-slate-950/80 backdrop-blur-md border-slate-800 py-3' : 'bg-transparent border-transparent py-5'
        ]">
            <div class="container mx-auto px-6 flex justify-between items-center">
                <div class="text-3xl font-bold bg-gradient-to-r from-primary-400 to-accent bg-clip-text text-transparent cursor-pointer logo-font"
                    @click="scrollTo('hero')">
                    Shiekh
                </div>

                <!-- Desktop Nav -->
                <nav class="hidden md:flex items-center space-x-8">
                    <button @click="scrollTo('about')" class="hover:text-primary-400 transition-colors">About</button>
                    <button @click="scrollTo('skills')" class="hover:text-primary-400 transition-colors">Skills</button>
                    <button @click="scrollTo('projects')"
                        class="hover:text-primary-400 transition-colors">Projects</button>
                    <button @click="scrollTo('experience')"
                        class="hover:text-primary-400 transition-colors">Experience</button>
                    <Link :href="route('education')" class="hover:text-primary-400 transition-colors">Education</Link>
                    <button @click="scrollTo('contact')"
                        class="px-5 py-2 bg-primary-600 hover:bg-primary-500 text-white rounded-full transition-all transform hover:scale-105 active:scale-95 shadow-lg shadow-primary-600/20">
                        Hire Me
                    </button>
                </nav>

                <!-- Mobile Nav Toggle -->
                <button class="md:hidden text-slate-200" @click="isMenuOpen = !isMenuOpen">
                    <Menu v-if="!isMenuOpen" />
                    <X v-else />
                </button>
            </div>

            <!-- Mobile Drawer (Side Menu) -->
            <transition enter-active-class="transition duration-500 cubic-bezier(0.16, 1, 0.3, 1)"
                enter-from-class="translate-x-full" enter-to-class="translate-x-0"
                leave-active-class="transition duration-400 ease-in" leave-from-class="translate-x-0"
                leave-to-class="translate-x-full">
                <div v-if="isMenuOpen" class="fixed inset-0 z-50 md:hidden overflow-hidden">
                    <!-- Overlay -->
                    <div class="absolute inset-0 bg-slate-950/60 backdrop-blur-md" @click="isMenuOpen = false"></div>

                    <!-- Drawer Content -->
                    <div
                        class="absolute top-0 right-0 w-3/4 h-full bg-slate-900 shadow-2xl border-l border-slate-800 flex flex-col p-8 rounded-l-[2.5rem]">
                        <div class="flex justify-between items-center mb-10">
                            <div
                                class="text-2xl font-black bg-gradient-to-r from-primary-400 to-accent bg-clip-text text-transparent logo-font">
                                Shiekh</div>
                            <button @click="isMenuOpen = false" class="p-2 bg-slate-800/50 rounded-xl text-slate-400">
                                <X :size="20" />
                            </button>
                        </div>

                        <div class="flex flex-col space-y-5">
                            <button v-for="(item, idx) in ['About', 'Skills', 'Projects', 'Experience']" :key="item"
                                @click="scrollTo(item.toLowerCase())" :style="{ transitionDelay: (idx * 100) + 'ms' }"
                                class="text-lg font-bold text-slate-300 hover:text-primary-400 text-left transition-all duration-300 transform"
                                :class="{ 'translate-x-0 opacity-100': isMenuOpen, '-translate-x-4 opacity-0': !isMenuOpen }">
                                <span class="flex items-center gap-3">
                                    <span
                                        class="w-1.5 h-1.5 rounded-full bg-primary-500/0 group-hover:bg-primary-500 transition-all"></span>
                                    {{ item }}
                                </span>
                            </button>
                            <Link :href="route('education')"
                                class="text-lg font-bold text-slate-300 hover:text-primary-400 text-left transition-all duration-300 transform"
                                :class="{ 'translate-x-0 opacity-100': isMenuOpen, '-translate-x-4 opacity-0': !isMenuOpen }">
                                <span class="flex items-center gap-3">
                                    <span
                                        class="w-1.5 h-1.5 rounded-full bg-primary-500/0 group-hover:bg-primary-500 transition-all"></span>
                                    Education
                                </span>
                            </Link>
                            <div class="pt-4">
                                <button @click="scrollTo('contact')"
                                    class="w-full px-6 py-3 bg-gradient-to-r from-primary-600 to-primary-500 text-white rounded-xl font-bold text-base shadow-lg shadow-primary-600/20 active:scale-95 transition-all">
                                    Hire Me
                                </button>
                            </div>
                        </div>

                        <div
                            class="mt-auto pt-8 border-t border-slate-800/50 flex space-x-5 justify-center text-slate-500">
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
                </div>
            </transition>
        </header>

        <main>
            <!-- Hero Section -->
            <section id="hero" class="relative min-h-screen flex items-center pt-28 pb-12 overflow-hidden">
                <!-- Background decorative elements -->
                <div class="absolute inset-0 z-0 overflow-hidden">
                    <div
                        class="absolute top-[10%] -left-20 w-[30rem] h-[30rem] bg-primary-600/20 rounded-full blur-[120px] animate-pulse">
                    </div>
                    <div class="absolute bottom-[10%] -right-20 w-[40rem] h-[40rem] bg-accent/10 rounded-full blur-[150px] animate-pulse"
                        style="animation-delay: 2s"></div>
                    <div
                        class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full h-full bg-[radial-gradient(circle_at_center,rgba(2,132,199,0.05)_0%,transparent_70%)]">
                    </div>
                </div>

                <div class="container mx-auto px-6 relative z-10">
                    <div class="grid lg:grid-cols-12 gap-12 items-center">
                        <!-- Text Content -->
                        <div
                            class="lg:col-span-7 animate-fade-in-up order-2 lg:order-1 flex flex-col items-center lg:items-start text-center lg:text-left">
                            <div
                                class="inline-flex items-center space-x-2 px-4 py-2 mb-8 text-sm font-medium bg-primary-500/10 text-primary-400 border border-primary-500/20 rounded-full backdrop-blur-sm">
                                <span class="relative flex h-2 w-2">
                                    <span
                                        class="animate-ping absolute inline-flex h-full w-full rounded-full bg-primary-400 opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-2 w-2 bg-primary-500"></span>
                                </span>
                                <span>Available for new projects</span>
                            </div>

                            <h1
                                class="text-4xl md:text-6xl lg:text-7xl font-extrabold mb-6 leading-[1.2] tracking-tight">
                                <span class="animate-slide-in-left inline-block md:mr-3">Hi, I'm</span><br
                                    class="md:hidden" />
                                <span
                                    class="bg-gradient-to-r from-primary-400 via-primary-500 to-accent bg-clip-text text-transparent animate-slide-in-right inline-block">Junaid
                                    Shiekh</span><br />
                                <span
                                    class="text-3xl md:text-5xl lg:text-6xl text-slate-100 animate-slide-in-up inline-block opacity-0 [animation-fill-mode:forwards] [animation-delay:400ms]">Full
                                    Stack Developer</span>
                            </h1>

                            <p class="text-lg md:text-xl text-slate-400 mb-10 max-w-2xl leading-relaxed">
                                Specializing in building high-performance, scalable web applications with
                                <span
                                    class="text-slate-200 font-semibold border-b border-primary-500/30">Laravel</span>,
                                <span class="text-slate-200 font-semibold border-b border-primary-500/30">Vue.js</span>,
                                and
                                <span
                                    class="text-slate-200 font-semibold border-b border-primary-500/30">Inertia.js</span>.
                                Turning complex problems into elegant solutions.
                            </p>

                            <div class="flex flex-col sm:flex-row gap-4 mb-12 w-full sm:w-auto">
                                <button @click="scrollTo('projects')"
                                    class="group relative px-8 py-4 bg-primary-600 hover:bg-primary-500 text-white rounded-2xl transition-all duration-300 transform hover:-translate-y-1 shadow-2xl shadow-primary-600/25 font-bold flex items-center justify-center gap-2 overflow-hidden">
                                    <div
                                        class="absolute inset-0 w-full h-full bg-gradient-to-r from-transparent via-white/10 to-transparent -translate-x-full group-hover:animate-shimmer">
                                    </div>
                                    <span>View My Work</span>
                                    <ExternalLink :size="18"
                                        class="group-hover:translate-x-1 group-hover:-translate-y-1 transition-transform" />
                                </button>
                                <button @click="scrollTo('contact')"
                                    class="px-8 py-4 bg-slate-800/50 hover:bg-slate-800 text-white border border-slate-700 rounded-2xl transition-all duration-300 transform hover:-translate-y-1 font-bold backdrop-blur-sm shadow-xl flex items-center justify-center">
                                    Get In Touch
                                </button>
                            </div>

                            <div class="flex flex-col md:flex-row items-center space-y-6 md:space-y-0 md:space-x-10">
                                <div class="flex -space-x-3">
                                    <div
                                        class="w-10 h-10 rounded-full border-2 border-slate-950 bg-slate-800 flex items-center justify-center text-xs font-bold text-primary-400">
                                        L</div>
                                    <div
                                        class="w-10 h-10 rounded-full border-2 border-slate-950 bg-slate-800 flex items-center justify-center text-xs font-bold text-emerald-400">
                                        V</div>
                                    <div
                                        class="w-10 h-10 rounded-full border-2 border-slate-950 bg-slate-800 flex items-center justify-center text-xs font-bold text-sky-400">
                                        I</div>
                                    <div
                                        class="w-10 h-10 rounded-full border-2 border-slate-950 bg-slate-800 flex items-center justify-center text-xs font-bold text-slate-400">
                                        +</div>
                                </div>
                                <div class="h-8 w-px bg-slate-800 hidden md:block"></div>
                                <div class="flex items-center space-x-5 text-slate-400">
                                    <a href="https://github.com/Junaid-Shiekh" target="_blank"
                                        class="hover:text-primary-400 transition-all transform hover:scale-110">
                                        <Github :size="22" />
                                    </a>
                                    <a href="#" class="hover:text-primary-400 transition-all transform hover:scale-110">
                                        <Linkedin :size="22" />
                                    </a>
                                    <a href="#" class="hover:text-primary-400 transition-all transform hover:scale-110">
                                        <Twitter :size="22" />
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Image Column -->
                        <div class="lg:col-span-5 order-1 lg:order-2">
                            <div class="relative max-w-[400px] mx-auto lg:max-w-none animate-float">
                                <!-- Glowing Background -->
                                <div
                                    class="absolute -inset-4 bg-gradient-to-tr from-primary-600/40 to-accent/40 rounded-full blur-3xl opacity-60 animate-pulse">
                                </div>

                                <div
                                    class="relative z-10 bg-gradient-to-br from-slate-900 to-slate-800 p-2 rounded-full border border-white/10 shadow-3xl overflow-hidden group">
                                    <div
                                        class="rounded-full overflow-hidden aspect-square bg-slate-800/50 flex items-center justify-center relative">
                                        <img src="/images/junaid.png" alt="Junaid Shiekh"
                                            class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" />

                                        <!-- Decorative overlays -->
                                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/40 to-transparent">
                                        </div>
                                    </div>
                                </div>

                                <!-- Floating Icons/Elements -->
                                <div
                                    class="absolute top-0 -right-4 w-16 h-16 bg-slate-900/80 backdrop-blur-md border border-slate-700 rounded-2xl shadow-2xl flex items-center justify-center animate-bounce duration-3000 delay-500 hidden sm:flex">
                                    <Layers class="text-primary-400" :size="28" />
                                </div>
                                <div
                                    class="absolute bottom-8 -left-4 w-14 h-14 bg-slate-900/80 backdrop-blur-md border border-slate-700 rounded-2xl shadow-2xl flex items-center justify-center animate-bounce duration-2000 hidden sm:flex">
                                    <Code class="text-accent" :size="24" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </section>

            <!-- About Section -->
            <section id="about" class="py-24 bg-slate-900/50 relative overflow-hidden">
                <div class="container mx-auto px-6">
                    <div class="grid lg:grid-cols-2 gap-16 items-center">
                        <div class="grid grid-cols-2 gap-4 sm:gap-6 order-2 lg:order-1">
                            <div class="space-y-4 sm:space-y-6">
                                <div
                                    class="group h-52 sm:h-64 bg-slate-800/40 p-6 rounded-[2rem] border border-slate-700/50 flex flex-col items-center justify-center text-center shadow-lg transform hover:-rotate-2 transition-all hover:bg-slate-800/80">
                                    <div
                                        class="text-4xl sm:text-5xl font-black text-primary-400 mb-2 group-hover:scale-110 transition-transform">
                                        3+</div>
                                    <div class="text-xs sm:text-sm text-slate-400 uppercase tracking-[0.2em] font-bold">
                                        Years Experience</div>
                                </div>
                                <div
                                    class="group h-44 sm:h-56 bg-slate-800/40 p-6 rounded-[2rem] border border-slate-700/50 flex flex-col items-center justify-center text-center shadow-lg transform hover:rotate-2 transition-all hover:bg-slate-800/80">
                                    <div
                                        class="text-4xl sm:text-5xl font-black text-accent mb-2 group-hover:scale-110 transition-transform">
                                        50+</div>
                                    <div class="text-xs sm:text-sm text-slate-400 uppercase tracking-[0.2em] font-bold">
                                        Projects Done</div>
                                </div>
                            </div>
                            <div class="space-y-4 sm:space-y-6 mt-8 sm:mt-12">
                                <div
                                    class="group h-44 sm:h-56 bg-slate-800/40 p-6 rounded-[2rem] border border-slate-700/50 flex flex-col items-center justify-center text-center shadow-lg transform hover:rotate-2 transition-all hover:bg-slate-800/80">
                                    <div
                                        class="text-4xl sm:text-5xl font-black text-blue-400 mb-2 group-hover:scale-110 transition-transform">
                                        100%</div>
                                    <div class="text-xs sm:text-sm text-slate-400 uppercase tracking-[0.2em] font-bold">
                                        Satisfaction</div>
                                </div>
                                <div
                                    class="group h-52 sm:h-64 bg-slate-800/40 p-6 rounded-[2rem] border border-slate-700/50 flex flex-col items-center justify-center text-center shadow-lg transform hover:-rotate-2 transition-all hover:bg-slate-800/80">
                                    <div
                                        class="text-4xl sm:text-5xl font-black text-teal-400 mb-2 group-hover:scale-110 transition-transform">
                                        24/7</div>
                                    <div class="text-xs sm:text-sm text-slate-400 uppercase tracking-[0.2em] font-bold">
                                        Support Availability</div>
                                </div>
                            </div>
                        </div>
                        <div
                            class="order-1 lg:order-2 flex flex-col items-center lg:items-start text-center lg:text-left">
                            <span
                                class="inline-block px-4 py-1.5 mb-6 text-sm font-bold text-primary-400 uppercase tracking-widest bg-primary-500/10 rounded-lg">About
                                Me</span>
                            <h2 class="text-3xl md:text-5xl font-extrabold mb-8 leading-tight text-white">Passionate
                                about Crafting <span
                                    class="text-transparent bg-clip-text bg-gradient-to-r from-primary-400 to-accent">Superior
                                    Code</span></h2>
                            <p class="text-lg text-slate-400 mb-6 leading-relaxed">
                                I am a dedicated Full Stack Developer with a deep love for the Laravel ecosystem. My
                                philosophy centers on writing clean, maintainable, and efficient code that translates
                                into seamless user experiences.
                            </p>
                            <p class="text-lg text-slate-400 mb-8 leading-relaxed">
                                Whether it's architecting complex backend systems or crafting pixel-perfect frontend
                                interfaces, I bring technical expertise and creative problem-solving to every project.
                            </p>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 w-full">
                                <div
                                    class="flex items-center justify-center lg:justify-start space-x-3 text-slate-300 p-4 bg-slate-800/30 rounded-2xl border border-slate-700/30">
                                    <div
                                        class="w-8 h-8 bg-accent/20 rounded-lg flex items-center justify-center shrink-0">
                                        <CheckCircle2 class="text-accent" :size="16" />
                                    </div>
                                    <span class="text-sm font-semibold">Laravel & Vue 3 Expert</span>
                                </div>
                                <div
                                    class="flex items-center justify-center lg:justify-start space-x-3 text-slate-300 p-4 bg-slate-800/30 rounded-2xl border border-slate-700/30">
                                    <div
                                        class="w-8 h-8 bg-accent/20 rounded-lg flex items-center justify-center shrink-0">
                                        <CheckCircle2 class="text-accent" :size="16" />
                                    </div>
                                    <span class="text-sm font-semibold">REST API Specialist</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Skills Section -->
            <section id="skills" class="py-24 relative overflow-hidden">
                <div class="container mx-auto px-6 relative z-10">
                    <div class="text-center mb-16">
                        <span
                            class="inline-block px-4 py-1.5 mb-4 text-sm font-bold text-accent uppercase tracking-[0.3em]">Knowledge</span>
                        <h2 class="text-3xl md:text-5xl font-black mb-4 text-white">Tech Stack & <span
                                class="text-primary-400">Expertise</span></h2>
                        <p class="text-slate-400 max-w-2xl mx-auto text-lg">I leverage the latest technologies to build
                            high-performance applications.</p>
                    </div>

                    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6 sm:gap-8">
                        <div v-for="cat in skillsData" :key="cat.category"
                            class="group relative bg-slate-900 border border-slate-800 p-8 rounded-[2.5rem] hover:border-primary-500/50 transition-all duration-300 shadow-xl hover:shadow-primary-500/5 hover:-translate-y-2 overflow-hidden">
                            <!-- Background gradient glow -->
                            <div
                                class="absolute -top-24 -right-24 w-48 h-48 bg-primary-600/5 rounded-full blur-[60px] group-hover:bg-primary-600/10 transition-colors">
                            </div>

                            <div
                                class="relative w-14 h-14 bg-slate-800 rounded-2xl flex items-center justify-center text-primary-400 mb-8 group-hover:bg-primary-500 group-hover:text-white transition-all duration-500 rotate-3 group-hover:rotate-0 shadow-lg shadow-black/20">
                                <component :is="cat.icon" :size="28" />
                            </div>

                            <h3 class="relative text-2xl font-black mb-8 capitalize text-white">{{ cat.category }}</h3>

                            <div class="relative grid grid-cols-2 gap-4">
                                <div v-for="skill in cat.items" :key="skill.name"
                                    class="flex flex-col items-center p-3 bg-slate-800/30 rounded-2xl border border-slate-700/30 hover:bg-slate-800/80 hover:border-slate-600 transition-all group/skill">
                                    <img :src="skill.icon" :alt="skill.name"
                                        class="w-8 h-8 mb-3 transition-transform group-hover/skill:scale-110" />
                                    <span
                                        class="text-[10px] font-black uppercase tracking-wider text-slate-400 group-hover/skill:text-slate-100 transition-colors">
                                        {{ skill.name }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Services Section -->
            <section id="services" class="py-24 bg-slate-900/30">
                <div class="container mx-auto px-6">
                    <div class="text-center mb-16">
                        <span
                            class="inline-block px-4 py-1.5 mb-4 text-sm font-bold text-primary-400 uppercase tracking-[0.3em]">Services</span>
                        <h2 class="text-3xl md:text-5xl font-black mb-4 text-white">What I Can <span
                                class="text-accent">Do For You</span></h2>
                        <p class="text-slate-400 max-w-2xl mx-auto text-lg">Comprehensive solutions for your digital
                            needs, from concept to deployment.</p>
                    </div>

                    <div class="grid sm:grid-cols-2 gap-6 sm:gap-8">
                        <div v-for="service in services" :key="service.title"
                            class="group bg-slate-800/20 p-8 md:p-12 rounded-[3rem] border border-slate-700/30 hover:bg-slate-800/40 hover:border-primary-500/30 transition-all duration-500 flex flex-col items-center text-center sm:items-start sm:text-left">
                            <div
                                class="w-16 h-16 bg-primary-500/10 rounded-[1.5rem] flex items-center justify-center text-primary-400 mb-8 group-hover:scale-110 group-hover:bg-primary-500 group-hover:text-white transition-all duration-500 shadow-xl shadow-primary-500/5">
                                <component :is="service.icon" :size="32" />
                            </div>
                            <h3 class="text-2xl md:text-3xl font-black mb-4 text-white uppercase tracking-tight">{{
                                service.title }}</h3>
                            <p class="text-slate-400 leading-relaxed text-lg">{{ service.description }}</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Projects Section -->
            <section id="projects" class="py-24">
                <div class="container mx-auto px-6">
                    <div class="flex flex-col md:flex-row justify-between items-end mb-16 gap-8">
                        <div>
                            <span
                                class="inline-block px-4 py-1.5 mb-4 text-sm font-bold text-accent uppercase tracking-[0.3em]">Portfolio</span>
                            <h2 class="text-3xl md:text-5xl font-black mb-4 text-white">Featured <span
                                    class="text-primary-400">Projects</span></h2>
                            <p class="text-slate-400 max-w-2xl text-lg">A selection of my best work, showcasing skills
                                in architecture and design.</p>
                        </div>
                        <a href="#"
                            class="group flex items-center space-x-3 text-primary-400 font-bold hover:text-primary-300 transition-colors">
                            <span>View All Projects</span>
                            <div
                                class="w-10 h-10 rounded-full border border-primary-500/30 flex items-center justify-center group-hover:bg-primary-500/10 transition-all">
                                <ExternalLink :size="18" />
                            </div>
                        </a>
                    </div>

                    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
                        <Link v-for="project in projects" :key="project.id"
                            :href="route('projects.show', project.slug || project.id)"
                            class="group bg-slate-900 border border-slate-800/50 rounded-[2.5rem] overflow-hidden hover:border-primary-500/30 transition-all duration-500 shadow-2xl hover:shadow-primary-500/5 block">
                            <div class="relative overflow-hidden aspect-[16/10]">
                                <img :src="project.image" :alt="project.title"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" />
                                <div
                                    class="absolute inset-0 bg-slate-950/80 opacity-0 group-hover:opacity-100 transition-all duration-500 flex flex-col items-center justify-center p-6 text-center">
                                    <p
                                        class="text-white font-bold mb-6 translate-y-4 group-hover:translate-y-0 transition-transform duration-500 text-lg">
                                        {{ project.title }}</p>
                                    <div
                                        class="flex items-center space-x-4 translate-y-4 group-hover:translate-y-0 transition-transform duration-500 delay-75 pointer-events-none">
                                        <div
                                            class="px-6 py-2 bg-primary-600 rounded-xl text-white font-black text-xs uppercase tracking-widest">
                                            View Project
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="p-8">
                                <div class="flex flex-wrap gap-2 mb-4">
                                    <span v-for="tech in project.tech_stack" :key="tech"
                                        class="text-[9px] uppercase font-black tracking-[0.15em] px-2.5 py-1 bg-primary-500/5 text-primary-400 border border-primary-500/10 rounded-lg">
                                        {{ tech }}
                                    </span>
                                </div>
                                <h3
                                    class="text-2xl font-black mb-3 text-white group-hover:text-primary-400 transition-colors">
                                    {{ project.title }}</h3>
                                <p class="text-slate-400 text-sm leading-relaxed line-clamp-2">{{ project.description }}
                                </p>
                            </div>
                        </Link>
                    </div>
                </div>
            </section>

            <!-- Experience Section -->
            <section id="experience" class="py-24 bg-slate-900/30">
                <div class="container mx-auto px-6">
                    <div class="text-center mb-16">
                        <h2 class="text-3xl md:text-5xl font-bold mb-4">Work Experience</h2>
                        <p class="text-slate-400">My professional journey in the world of development.</p>
                    </div>

                    <div class="max-w-4xl mx-auto space-y-12">
                        <div v-for="exp in experiences" :key="exp.id"
                            class="relative pl-12 before:absolute before:left-0 before:top-2 before:bottom-0 before:w-px before:bg-slate-700 after:absolute after:left-[-4px] after:top-2 after:w-2 after:h-2 after:bg-primary-500 after:rounded-full after:ring-4 after:ring-primary-500/20">
                            <div class="bg-slate-800/40 p-4 md:p-8 rounded-3xl border border-slate-700/50">
                                <div class="flex flex-col md:flex-row justify-between mb-4 gap-2">
                                    <div>
                                        <h3
                                            class="text-lg md:text-xl font-bold text-slate-100 uppercase tracking-tight">
                                            {{ exp.job_title }}</h3>
                                        <p class="text-primary-400 font-bold md:text-base text-[9px]">{{
                                            exp.company_name }}</p>
                                        <p v-if="exp.location"
                                            class="text-slate-500 text-[7px] md:text-xs mt-1 flex items-center gap-1.5 leading-none">
                                            <MapPin :size="10" class="md:hidden" />
                                            <MapPin :size="12" class="hidden md:block" />
                                            {{ exp.location }}
                                        </p>
                                    </div>
                                    <span
                                        class="px-3 py-1 md:px-4 md:py-1.5 bg-slate-900 text-slate-400 text-[7px] md:text-xs font-bold rounded-full border border-slate-700 self-start">
                                        {{ new Date(exp.start_date).toLocaleDateString('en-US', {
                                            month: 'short', year:
                                                'numeric'
                                        }) }} -
                                        {{ exp.is_current ? 'Present' : new
                                            Date(exp.end_date).toLocaleDateString('en-US', {
                                                month: 'short', year: 'numeric'
                                            }) }}
                                    </span>
                                </div>
                                <p class="text-slate-400 text-[7px] md:text-base leading-relaxed whitespace-pre-line">{{
                                    exp.description }}</p>
                            </div>
                        </div>

                        <!-- Empty State if no experience -->
                        <div v-if="experiences.length === 0" class="text-center py-12 text-slate-500">
                            Professional journey details coming soon.
                        </div>
                    </div>
                </div>
            </section>

            <!-- Contact Section -->
            <section id="contact" class="py-24 relative">
                <div class="container mx-auto px-6">
                    <div
                        class="bg-gradient-to-br from-slate-900 to-slate-800 rounded-[3rem] p-8 md:p-16 border border-slate-700/50 shadow-2xl relative overflow-hidden">
                        <div class="absolute top-0 right-0 p-8">
                            <MessageSquare :size="100" class="text-primary-400/5 -rotate-12" />
                        </div>

                        <div class="grid lg:grid-cols-2 gap-16 items-center relative z-10">
                            <div>
                                <h2 class="text-2xl md:text-5xl font-bold mb-6">Let's build something <span
                                        class="text-primary-400">extraordinary</span> together.</h2>
                                <p class="text-slate-400 text-base md:text-lg mb-10">
                                    Ready to start your project? Have a question? I'm always open to discussing new
                                    opportunities and creative ideas.
                                </p>
                            </div>

                            <form @submit.prevent="submit"
                                class="bg-slate-950/50 p-6 md:p-10 rounded-[2.5rem] border border-slate-700/50 backdrop-blur-md shadow-2xl relative">
                                <div class="grid md:grid-cols-1 gap-4 md:gap-6">
                                    <div class="group">
                                        <label
                                            class="block text-[10px] md:text-sm font-bold text-slate-500 mb-1.5 ml-1 uppercase tracking-widest transition-colors group-focus-within:text-primary-400">Full
                                            Name</label>
                                        <input v-model="form.name" type="text" required
                                            class="w-full bg-slate-900/40 border border-slate-800 rounded-2xl px-4 py-2.5 md:px-6 md:py-4 text-xs md:text-base focus:outline-none focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500/50 transition-all font-medium"
                                            placeholder="John Doe">
                                    </div>
                                    <div class="group">
                                        <label
                                            class="block text-[10px] md:text-sm font-bold text-slate-500 mb-1.5 ml-1 uppercase tracking-widest transition-colors group-focus-within:text-primary-400">Email
                                            Address</label>
                                        <input v-model="form.email" type="email" required
                                            class="w-full bg-slate-900/40 border border-slate-800 rounded-2xl px-4 py-2.5 md:px-6 md:py-4 text-xs md:text-base focus:outline-none focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500/50 transition-all font-medium"
                                            placeholder="john@example.com">
                                    </div>
                                    <div class="group">
                                        <label
                                            class="block text-[10px] md:text-sm font-bold text-slate-500 mb-1.5 ml-1 uppercase tracking-widest transition-colors group-focus-within:text-primary-400">Your
                                            Message</label>
                                        <textarea v-model="form.message" rows="4" required
                                            class="w-full bg-slate-900/40 border border-slate-800 rounded-2xl px-4 py-2.5 md:px-6 md:py-4 text-xs md:text-base focus:outline-none focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500/50 transition-all resize-none font-medium"
                                            placeholder="Tell me about your project..."></textarea>
                                    </div>
                                    <button type="submit" :disabled="form.processing"
                                        class="w-full py-3.5 md:py-5 bg-primary-600 hover:bg-primary-500 disabled:opacity-50 text-white rounded-2xl font-black text-sm md:text-lg transition-all flex items-center justify-center space-x-3 shadow-xl shadow-primary-600/20 active:scale-[0.98] overflow-hidden group/btn">
                                        <div
                                            class="absolute inset-0 w-full h-full bg-gradient-to-r from-transparent via-white/10 to-transparent -translate-x-full group-hover/btn:animate-shimmer transition-transform">
                                        </div>
                                        <Send v-if="!form.processing" :size="20"
                                            class="group-hover/btn:translate-x-1 group-hover/btn:-translate-y-1 transition-transform" />
                                        <span>{{ form.processing ? 'Sending...' : 'Send Message' }}</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <!-- Footer -->
        <footer class="py-12 border-t border-slate-800">
            <div class="container mx-auto px-6 flex flex-col md:flex-row justify-between items-center gap-8">
                <div
                    class="text-3xl font-bold bg-gradient-to-r from-primary-400 to-accent bg-clip-text text-transparent logo-font">
                    Shiekh
                </div>

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
                    <a href="#" class="hover:text-primary-400 transition-colors">
                        <Instagram :size="20" />
                    </a>
                </div>
            </div>
        </footer>
    </div>
</template>

<style>
.glassmorphism {
    background: rgba(15, 23, 42, 0.4);
    backdrop-filter: blur(8px);
    -webkit-backdrop-filter: blur(8px);
}

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

@keyframes float {

    0%,
    100% {
        transform: translateY(0) rotate(0);
    }

    50% {
        transform: translateY(-20px) rotate(2deg);
    }
}

.animate-float {
    animation: float 6s ease-in-out infinite;
}

@keyframes shimmer {
    100% {
        transform: translateX(100%);
    }
}

.animate-shimmer {
    animation: shimmer 2s infinite;
}

@keyframes slideInLeft {
    from {
        opacity: 0;
        transform: translateX(-50px);
    }

    to {
        opacity: 1;
        transform: translateX(0);
    }
}

.animate-slide-in-left {
    animation: slideInLeft 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
}

@keyframes slideInRight {
    from {
        opacity: 0;
        transform: translateX(50px);
    }

    to {
        opacity: 1;
        transform: translateX(0);
    }
}

.animate-slide-in-right {
    animation: slideInRight 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
}

@keyframes slideInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-slide-in-up {
    animation: slideInUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
}
</style>
