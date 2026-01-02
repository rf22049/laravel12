<?php
require_once 'user.php';

class Admin extends User {
    public $role = "Administrator";

    public function setPassword($value) {
        if (strlen($value) >= 10) {
            parent::setPassword($value); 
        } else {
            parent::setPassword("admin_secure_123");
        }
    }

    public function viewAllUsers() {
        return [
            ['id' => 1, 'username' => 'lilo_user', 'email' => 'lilo@gmail.com'],
            ['id' => 2, 'username' => 'budi_web', 'email' => 'budi@yahoo.com'],
            ['id' => 3, 'username' => 'siti_dev', 'email' => 'siti@outlook.com']
        ];
    }

    public function manageData($action, $dataId) {
        return "Admin telah berhasil melakukan tindakan: <b>$action</b> pada data ID: <b>$dataId</b>.";
    }

    public function deleteData($dataId) {
        return "Data dengan ID <b>$dataId</b> telah dihapus secara permanen dari sistem.";
    }
}

//contoh makenya

$admin = new Admin("super_admin", "admin@webprog.com", "rahasiaNegara123");

// Test Method Overriding
$admin->setPassword("pendek");

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Admin - Inheritance PHP</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 p-6 md:p-12">
    <div class="max-w-4xl mx-auto space-y-8">
        <header class="border-b pb-4">
            <h1 class="text-3xl font-bold text-gray-800">Sistem Manajemen Admin</h1>
            <p class="text-gray-600">Implementasi Inheritance & Method Overriding</p>
        </header>

        <div class="bg-white p-6 rounded-xl shadow-md border-l-4 border-blue-600">
            <h2 class="text-xl font-semibold mb-4 text-blue-700">Profil Login</h2>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <p class="text-sm text-gray-500 uppercase">Username</p>
                    <p class="font-medium text-lg"><?php echo $admin->username; ?></p>
                </div>
                <div>
                    <p class="text-sm text-gray-500 uppercase">Role</p>
                    <p class="font-medium text-lg text-red-600"><?php echo $admin->role; ?></p>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-md">
            <h2 class="text-xl font-semibold mb-4">Fitur: viewAllUsers()</h2>
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="p-3 border">ID</th>
                        <th class="p-3 border">Username</th>
                        <th class="p-3 border">Email</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($admin->viewAllUsers() as $u): ?>
                    <tr>
                        <td class="p-3 border"><?php echo $u['id']; ?></td>
                        <td class="p-3 border"><?php echo $u['username']; ?></td>
                        <td class="p-3 border"><?php echo $u['email']; ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="grid md:grid-cols-2 gap-6">
            <div class="bg-green-50 p-6 rounded-xl border border-green-200">
                <h3 class="font-bold text-green-800 mb-2 underline">Method: manageData()</h3>
                <p class="text-green-700 italic">"<?php echo $admin->manageData('UPDATE_CONFIG', 101); ?>"</p>
            </div>
            <div class="bg-red-50 p-6 rounded-xl border border-red-200">
                <h3 class="font-bold text-red-800 mb-2 underline">Method: deleteData()</h3>
                <p class="text-red-700 italic">"<?php echo $admin->deleteData(505); ?>"</p>
            </div>
        </div>
        
    </div>
</body>
</html>