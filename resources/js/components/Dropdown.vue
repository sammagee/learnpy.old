<template>
    <div class="relative" @keydown.esc="isOpen = false">
        <slot name="trigger" :toggle="toggle"></slot>

        <button
            class="cursor-default fixed inset-0 h-full w-full z-10 focus:outline-none"
            v-show="isOpen"
            @click="isOpen = false"></button>
        
        <transition
            enter-active-class="transition ease-out duration-100 transform"
            enter-class="opacity-0 scale-95"
            enter-to-class="opacity-100 scale-100"
            leave-active-class="transition ease-in duration-75 transform"
            leave-class="opacity-100 scale-100"
            leave-to-class="opacity-0 scale-95">
            <div class="rounded-md shadow-lg z-20" :class="dropdownClass" v-show="isOpen">
                <div class="py-1 rounded-md shadow-xs" :class="dropdownInnerClass" role="menu" aria-orientation="vertical" aria-labelledby="user-menu">
                    <slot></slot>
                </div>
            </div>
        </transition>
    </div>
</template>

<script>
    export default {
        name: 'dropdown',

        props: ['dropdownClass', 'dropdownInnerClass'],

        data: () => ({
            isOpen: false
        }),

        methods: {
            toggle() {
                this.isOpen = !this.isOpen;
            },
        },
    }
</script>
