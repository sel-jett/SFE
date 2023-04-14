import { defineStore } from 'pinia'

export const useGeneralStore = defineStore('general',{
    state: () => ({
        isPostOverlay: false,
        isCropperModel: false,
        isImageDisplay: null
    }),
    persist: true,
})