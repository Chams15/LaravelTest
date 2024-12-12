<x-layout>
    <div class="parent-container">
        <div class="container-login">
            <h1>Login</h1>

            <form action="/login" class="form" autocomplete="off" method="POST">
                @csrf
                <label>Email</label>
                <input type="text" name="email">
                <label>Password</label>
                <input type="password" name="password" autocomplete="new-password">

                <div class="buttons-container">
                    <button type="submit" class="login-button">Login</button>
                    <label>Don't have an account?</label>
                    <a href="/register" class="register-button">Register</a>
                </div>
            </form>
        </div>
    </div>

</x-layout>

<style>
    .parent-container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .container-login {
        color: rgba(0, 0, 0, 0.8);
        background-color: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
        border: 1px solid #ddd;
        display: flex;
        flex-direction: column;
        width: 300px;
    }

    .form {
        display: flex;
        flex-direction: column;
    }

    .login-button {
        border: 0;
        background-color: #3C9AE2;
        color: white;
        border-radius: 5px;
        margin-top: 20px;
        padding: 5px 5px;
        width: 100%;
        margin-bottom: 15px;
    }

    .buttons-container {

        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    h1 {
        font-weight: bold;
    }

    input {
        border-radius: 5px;
        border: 1px solid #999;
        padding: 5px;
        margin-bottom: 10px;
    }

    .register-button {
        color: black;
        margin-top: 10px;
    }
</style>