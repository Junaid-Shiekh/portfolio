<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head, router } from '@inertiajs/vue3';
import { 
    Check, 
    Trash2, 
    Mail, 
    User, 
    Clock, 
    MessageSquare,
    Search,
    Inbox
} from 'lucide-vue-next';
import Swal from 'sweetalert2';
import { ref, computed } from 'vue';

const props = defineProps({
    messages: Array
});

const searchQuery = ref('');

const filteredMessages = computed(() => {
    if (!searchQuery.value) return props.messages;
    const query = searchQuery.value.toLowerCase();
    return props.messages.filter(msg => 
        msg.name.toLowerCase().includes(query) || 
        msg.email.toLowerCase().includes(query) || 
        msg.message.toLowerCase().includes(query)
    );
});

const markAsRead = (id) => {
    Swal.fire({
        title: 'Mark as Read?',
        text: "This will change status to Read and send a thank you email to the user.",
        icon: 'info',
        showCancelButton: true,
        background: '#0f172a',
        color: '#f8fafc',
        confirmButtonColor: '#3b82f6',
        cancelButtonColor: '#334155',
        confirmButtonText: 'Yes, mark as read',
        customClass: {
            container: 'font-sans',
            popup: 'rounded-[2rem] border border-slate-800',
            title: 'text-2xl font-black text-white',
            confirmButton: 'px-6 py-2.5 rounded-xl font-bold uppercase tracking-widest text-xs',
            cancelButton: 'px-6 py-2.5 rounded-xl font-bold uppercase tracking-widest text-xs'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            router.post(route('admin.messages.read', id), {}, {
                onSuccess: () => {
                    Swal.fire({
                        title: 'Success!',
                        text: 'Message marked as read and email sent.',
                        icon: 'success',
                        background: '#0f172a',
                        color: '#f8fafc',
                        confirmButtonColor: '#0284c7',
                        customClass: {
                            popup: 'rounded-[1.5rem] border border-slate-800',
                        }
                    });
                }
            });
        }
    });
};

const deleteMessage = (id) => {
    Swal.fire({
        title: 'Delete Message?',
        text: "This action cannot be undone.",
        icon: 'warning',
        showCancelButton: true,
        background: '#0f172a',
        color: '#f8fafc',
        confirmButtonColor: '#e11d48',
        cancelButtonColor: '#334155',
        confirmButtonText: 'Delete',
        customClass: {
            container: 'font-sans',
            popup: 'rounded-[2rem] border border-slate-800',
            title: 'text-2xl font-black text-white',
            confirmButton: 'px-6 py-2.5 rounded-xl font-bold uppercase tracking-widest text-xs',
            cancelButton: 'px-6 py-2.5 rounded-xl font-bold uppercase tracking-widest text-xs'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            router.delete(route('admin.messages.destroy', id), {
                onSuccess: () => {
                    Swal.fire({
                        title: 'Deleted!',
                        text: 'Message has been removed.',
                        icon: 'success',
                        background: '#0f172a',
                        color: '#f8fafc',
                        confirmButtonColor: '#0284c7',
                        customClass: {
                            popup: 'rounded-[1.5rem] border border-slate-800',
                        }
                    });
                }
            });
        }
    });
};

const formatDate = (dateString) => {
    return new Date(dateString).toLocaleDateString('en-US', {
        month: 'short',
        day: 'numeric',
        year: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    });
};
</script>

<template>
    <Head title="Messages" />

    <AdminLayout>
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-12">
            <div>
                <h1 class="text-3xl font-black text-white">Inbound Messages</h1>
                <p class="text-slate-400">Manage communication from your portfolio visitors.</p>
            </div>
            <div class="flex items-center gap-4 bg-slate-900/50 border border-slate-800 rounded-2xl px-6 py-3">
                <div class="flex flex-col items-end">
                    <span class="text-xs font-bold text-slate-500 uppercase tracking-widest">Total Messages</span>
                    <span class="text-xl font-black text-white">{{ messages.length }}</span>
                </div>
                <div class="w-px h-8 bg-slate-800"></div>
                <div class="flex flex-col items-start">
                    <span class="text-xs font-bold text-slate-500 uppercase tracking-widest">Pending</span>
                    <span class="text-xl font-black text-amber-500">{{ messages.filter(m => m.status === 'pending').length }}</span>
                </div>
            </div>
        </div>

        <!-- Search -->
        <div class="relative mb-8">
            <Search class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-500" :size="20" />
            <input 
                v-model="searchQuery"
                type="text" 
                placeholder="Search by name, email or message content..."
                class="w-full bg-slate-900/50 border border-slate-800 rounded-2xl pl-12 pr-6 py-4 text-white placeholder:text-slate-600 focus:outline-none focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500/50 transition-all font-medium" 
            />
        </div>

        <!-- Messages List -->
        <div v-if="filteredMessages.length > 0" class="space-y-4">
            <div v-for="message in filteredMessages" :key="message.id" 
                class="group bg-slate-900/40 border border-slate-800 hover:border-slate-700 rounded-[1.5rem] p-6 transition-all duration-300">
                <div class="flex flex-col md:flex-row gap-6">
                    <!-- Avatar/Initial -->
                    <div class="flex-shrink-0">
                        <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-slate-800 to-slate-900 border border-slate-700/50 flex items-center justify-center text-2xl font-black text-white shadow-inner">
                            {{ message.name.charAt(0).toUpperCase() }}
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="flex-1 min-w-0">
                        <div class="flex flex-col md:flex-row md:items-center justify-between gap-2 mb-3">
                            <div>
                                <h3 class="text-lg font-bold text-white flex items-center gap-2">
                                    {{ message.name }}
                                    <span v-if="message.status === 'read'" class="px-2 py-0.5 bg-emerald-500/10 text-emerald-500 border border-emerald-500/20 rounded text-[10px] font-black uppercase tracking-wider">Read</span>
                                    <span v-else class="px-2 py-0.5 bg-amber-500/10 text-amber-500 border border-amber-500/20 rounded text-[10px] font-black uppercase tracking-wider">Pending</span>
                                </h3>
                                <div class="flex flex-wrap items-center gap-4 mt-1 text-sm text-slate-500">
                                    <span class="flex items-center gap-1.5"><Mail :size="14" class="text-slate-600" /> {{ message.email }}</span>
                                    <span class="flex items-center gap-1.5"><Clock :size="14" class="text-slate-600" /> {{ formatDate(message.created_at) }}</span>
                                </div>
                            </div>
                            
                            <!-- Actions -->
                            <div class="flex items-center gap-2">
                                <button 
                                    v-if="message.status !== 'read'"
                                    @click="markAsRead(message.id)"
                                    class="p-3 bg-emerald-500/10 text-emerald-500 hover:bg-emerald-500 hover:text-white border border-emerald-500/20 rounded-xl transition-all"
                                    title="Mark as Read"
                                >
                                    <Check :size="18" />
                                </button>
                                <button 
                                    @click="deleteMessage(message.id)"
                                    class="p-3 bg-red-500/10 text-red-500 hover:bg-red-500 hover:text-white border border-red-500/20 rounded-xl transition-all"
                                    title="Delete Message"
                                >
                                    <Trash2 :size="18" />
                                </button>
                            </div>
                        </div>

                        <div class="bg-slate-950/40 border border-slate-800/50 rounded-xl p-4 mt-4 relative">
                            <MessageSquare :size="16" class="absolute -top-3 -left-2 text-slate-700 bg-slate-900 rounded-full" />
                            <p class="text-slate-300 leading-relaxed whitespace-pre-line">{{ message.message }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Empty State -->
        <div v-else class="flex flex-col items-center justify-center py-24 text-center">
            <div class="w-24 h-24 bg-slate-900 border border-slate-800 rounded-[2rem] flex items-center justify-center text-slate-700 mb-8">
                <Inbox :size="48" />
            </div>
            <h2 class="text-2xl font-black text-white mb-2">No Messages Found</h2>
            <p class="text-slate-400 max-w-sm">When visitors reach out to you via the portfolio, their messages will appear here.</p>
        </div>
    </AdminLayout>
</template>
