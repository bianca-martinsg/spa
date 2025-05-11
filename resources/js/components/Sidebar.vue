<template>
    <aside class="sidebar">
        <div class="logo text-center mb-4">
            <img :src="logo" alt="Logo" class="img-fluid" />
        </div>
        <button class="nav-button">
            <i class="bi bi-card-list" aria-label="Lista de navegação"></i>
        </button>
        <div class="sidebar-spacer"></div>
        <div class="sidebar-bottom">
            <div class="user-avatar mb-4">
                <img :src="avatar" alt="Avatar" class="img-fluid" />
            </div>
            <button class="logout-button" aria-label="Sair">
                <i class="bi bi-box-arrow-right"></i>
            </button>
        </div>
    </aside>
</template>

<script>
export default {
    props: {
        logo: String,
        avatar: String,
    }
};
</script>

<style scoped>
/* Mantenha o estilo que já estava no seu arquivo original */
</style>