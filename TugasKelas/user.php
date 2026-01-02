<?php
class User {
    public $username;
    public $email;
    
    private $_password = "";

    public function __construct($username, $email, $password) {
        $this->username = $username;
        $this->email = $email;
        $this->setPassword($password);
    }

    public function setPassword($value) {
        if (strlen($value) >= 6) {
            $this->_password = $value;
        } else {
            $this->_password = "default123"; 
        }
    }

    public function getPassword() {
        return str_repeat('*', 8);
    }

    public function checkPassword($input) {
        return $input === $this->_password;
    }
}

// buat testing
$user = new User("lilo_user", "lilo@gmail.com", "secure123");
$checkResult = null;
$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = isset($_POST['password']) ? $_POST['password'] : '';
    if (empty($input)) {
        $error = "Silahkan masukkan password untuk pengecekan.";
    } else {
        $checkResult = $user->checkPassword($input);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile - OOP PHP</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">

    <div class="max-w-md mx-auto bg-white p-8 rounded-xl shadow-lg">
        <h1 class="text-2xl font-bold mb-6 text-gray-800 border-b pb-2">Profil Pengguna</h1>
        
        <div class="space-y-4 mb-8">
            <div>
                <label class="block text-sm font-medium text-gray-500">Username</label>
                <p class="text-lg font-semibold text-gray-800"><?php echo htmlspecialchars($user->username); ?></p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-500">Email</label>
                <p class="text-lg font-semibold text-gray-800"><?php echo htmlspecialchars($user->email); ?></p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-500">Password (Masked)</label>
                <p class="text-lg font-mono text-gray-600"><?php echo $user->getPassword(); ?></p>
            </div>
        </div>

        <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
            <h2 class="text-sm font-bold uppercase text-gray-400 mb-3 tracking-wider">Cek Validasi Password</h2>
            <form method="post" action="" class="space-y-3">
                <input type="password" name="password" 
                       class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500 outline-none" 
                       placeholder="Masukkan password asli...">
                <button type="submit" 
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 rounded-md transition duration-200">
                    Verifikasi
                </button>
            </form>

            <?php if ($checkResult !== null): ?>
                <div class="mt-4 p-3 rounded-md text-center font-medium <?php echo $checkResult ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700'; ?>">
                    <?php echo $checkResult ? "✅ Password Benar!" : "❌ Password Salah!"; ?>
                </div>
            <?php endif; ?>

            <?php if ($error): ?>
                <div class="mt-4 p-3 bg-yellow-100 text-yellow-700 rounded-md text-sm">
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="mt-6 text-center">
            <a href="admin.php" class="text-blue-500 hover:underline text-sm">Masuk ke Dashboard Admin &rarr;</a>
        </div>
    </div>

</body>
</html>