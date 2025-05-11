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
import logo from '@assets/logo.png';
import avatar from '@assets/avatar.png';

export default {
    props: {
        logo: {
            type: String,
            default: logo
        },
        avatar: {
            type: String,
            default: avatar
        }
    }
};
</script>

<style scoped>
.sidebar {
    width: 76px;
    background-color: #F0ECE4;
    height: 100vh;
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 48px 0;
}

.logo img {
    width: 48px;
    height: 48px;
}

.nav-button {
    background-color: #E6E1D6;
    border: none;
    width: 100%;
    text-align: center;
    font-size: 20px;
    color: #50565B;
    padding: 8px 0;
}

.sidebar-spacer {
    flex-grow: 1;
}

.sidebar-bottom {
    text-align: center;
}

.user-avatar img {
    width: 32px;
    height: 32px;
}

.logout-button {
    background: none;
    border: none;
    color: #50565B;
    font-size: 16px;
    margin-top: 5px;
}
</style>
