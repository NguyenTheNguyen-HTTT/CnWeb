<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>14 Loại Hoa Tuyệt Đẹp Dịp Xuân Hè</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome cho icon -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .hero-section {
            background: linear-gradient(135deg, #a8e063 0%, #56ab2f 100%);
            color: white;
            padding: 40px 0;
            margin-bottom: 30px;
            border-radius: 0 0 20px 20px;
        }
        .card-flower {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            height: 100%;
            border: none;
            border-radius: 15px;
            overflow: hidden;
        }
        .card-flower:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        .flower-img {
            height: 200px;
            object-fit: cover;
            width: 100%;
        }
        .admin-table img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 8px;
        }
        .btn-floating {
            position: fixed;
            bottom: 30px;
            right: 30px;
            z-index: 1000;
        }
        /* Style riêng cho chế độ xem */
        .view-section {
            display: none; /* Mặc định ẩn tất cả */
            animation: fadeIn 0.5s;
        }
        .view-section.active {
            display: block; /* Hiện section đang chọn */
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
    </style>
</head>
<body>

    <!-- Navbar chuyển đổi chế độ -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-success sticky-top shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="#"><i class="fas fa-leaf me-2"></i>Flora Việt Nam</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#" onclick="switchView('guest', this)"><i class="fas fa-users me-1"></i> Giao diện Khách</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="switchView('admin', this)"><i class="fas fa-user-cog me-1"></i> Giao diện Quản trị</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Header -->
    <div class="container-fluid hero-section text-center">
        <h1>14 Loại Hoa Tuyệt Đẹp Khoe Sắc Xuân Hè</h1>
        <p class="lead">Tuyển tập những loài hoa dễ trồng và rực rỡ nhất cho khu vườn của bạn</p>
    </div>

    <div class="container mb-5">
        <!-- GIAO DIỆN KHÁCH (GUEST) -->
        <div id="guest-view" class="view-section active">
            <h3 class="text-success mb-4 border-bottom pb-2">Danh sách các loài hoa</h3>
            <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 g-4" id="flower-grid">
                <!-- Dữ liệu hoa sẽ được render vào đây -->
            </div>
        </div>

        <!-- GIAO DIỆN QUẢN TRỊ (ADMIN) -->
        <div id="admin-view" class="view-section">
            <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">
                <h3 class="text-primary">Quản lý danh sách hoa</h3>
                <button class="btn btn-primary" onclick="openModal()"><i class="fas fa-plus me-2"></i>Thêm hoa mới</button>
            </div>
            
            <div class="card shadow-sm">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped align-middle mb-0">
                            <thead class="table-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Hình ảnh</th>
                                    <th>Tên hoa</th>
                                    <th>Mô tả</th>
                                    <th class="text-end">Hành động</th>
                                </tr>
                            </thead>
                            <tbody id="flower-table-body">
                                <!-- Dữ liệu bảng sẽ được render vào đây -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Thêm/Sửa Hoa -->
    <div class="modal fade" id="flowerModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Thêm hoa mới</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="flowerForm">
                        <input type="hidden" id="flowerIndex">
                        <div class="mb-3">
                            <label class="form-label">Tên hoa</label>
                            <input type="text" class="form-control" id="flowerName" required placeholder="Ví dụ: Hoa Dạ Yến Thảo">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Đường dẫn ảnh (images/)</label>
                            <input type="text" class="form-control" id="flowerImage" required placeholder="images/ten_anh.jpg">
                            <small class="text-muted">Lưu ý: Hệ thống sẽ tự dùng ảnh mạng nếu ảnh cục bộ lỗi.</small>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Mô tả</label>
                            <textarea class="form-control" id="flowerDesc" rows="3" required placeholder="Mô tả vẻ đẹp và đặc tính..."></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-success" onclick="saveFlower()">Lưu lại</button>
                </div>
            </div>
        </div>
    </div>

   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // 1. DỮ LIỆU KHỞI TẠO (Mảng lưu trữ thông tin flowers)
        // Lưu ý: Đường dẫn ảnh được đặt là 'images/...' theo yêu cầu đề bài.
        // Tuy nhiên, thuộc tính 'fallback' được thêm vào để code chạy được ngay trên trình duyệt (preview) mà không cần file ảnh thật.
        let flowers = [
            { name: "Hoa Đỗ Quyên", image: "hoadep/doquyen.jpg", fallback: "https://images.unsplash.com/photo-1558293842-c0fd3db84598?auto=format&fit=crop&w=600&q=80", description: "Loài hoa nở rực rỡ, nhiều màu sắc, thích hợp trồng ở ban công hoặc chậu treo." },
            { name: "Hoa Hải Dương", image: "hoadep/haiduong.jpg", fallback: "https://images.unsplash.com/photo-1572454591674-2739f30d8c40?auto=format&fit=crop&w=600&q=80", description: "Hoa tượng trưng cho sự sung túc, tài lộc, rất dễ trồng và nở quanh năm." },
            { name: "Hoa Mai", image: "hoadep/mai.jpg", fallback: "https://images.unsplash.com/photo-1534268625901-2622479e0a02?auto=format&fit=crop&w=600&q=80", description: "Sức sống mãnh liệt, chịu hạn tốt, tạo bóng mát và vẻ đẹp rực rỡ cho cổng nhà." },
            { name: "Hoa Tường Vy", image: "hoadep/tuongvy.jpg", fallback: "https://upload.wikimedia.org/wikipedia/commons/thumb/1/1a/Evolvulus_glomeratus1.jpg/640px-Evolvulus_glomeratus1.jpg", description: "Màu xanh thiên thanh dịu mát, dáng hoa nhỏ xinh, chịu nắng rất tốt." },
        ]

        // Biến modal bootstrap
        let flowerModal;

        // 2. HÀM XỬ LÝ HIỂN THỊ (VIEW)
        document.addEventListener('DOMContentLoaded', () => {
            flowerModal = new bootstrap.Modal(document.getElementById('flowerModal'));
            renderGuest();
            renderAdmin();
        });

        // Hàm chuyển đổi tab
        function switchView(viewName, element) {
            // Ẩn tất cả view
            document.querySelectorAll('.view-section').forEach(el => el.classList.remove('active'));
            // Bỏ active nav link
            document.querySelectorAll('.nav-link').forEach(el => el.classList.remove('active'));
            
            // Hiện view được chọn
            document.getElementById(viewName + '-view').classList.add('active');
            // Active nav link hiện tại
            element.classList.add('active');
        }

        // Render cho khách (Dạng lưới/Card)
        function renderGuest() {
            const container = document.getElementById('flower-grid');
            container.innerHTML = '';
            
            flowers.forEach((flower, index) => {
                // Xử lý fallback hình ảnh: Nếu user chưa có folder images/, dùng ảnh online
                const imgSrc = flower.image; 
                
                const html = `
                    <div class="col">
                        <div class="card card-flower shadow-sm">
                            <img src="${imgSrc}" class="flower-img card-img-top" alt="${flower.name}" onerror="this.onerror=null; this.src='${flower.fallback}';">
                            <div class="card-body">
                                <h5 class="card-title text-success">${flower.name}</h5>
                                <p class="card-text text-muted small">${flower.description}</p>
                            </div>
                        </div>
                    </div>
                `;
                container.innerHTML += html;
            });
        }

        // Render cho Admin (Dạng bảng CRUD)
        function renderAdmin() {
            const tbody = document.getElementById('flower-table-body');
            tbody.innerHTML = '';

            flowers.forEach((flower, index) => {
                const html = `
                    <tr>
                        <td>${index + 1}</td>
                        <td>
                            <img src="${flower.image}" alt="${flower.name}" onerror="this.onerror=null; this.src='${flower.fallback}';">
                        </td>
                        <td class="fw-bold">${flower.name}</td>
                        <td>${flower.description}</td>
                        <td class="text-end">
                            <button class="btn btn-sm btn-outline-primary me-1" onclick="editFlower(${index})">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-sm btn-outline-danger" onclick="deleteFlower(${index})">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                `;
                tbody.innerHTML += html;
            });
        }

        // 3. CÁC HÀM CRUD (Xử lý dữ liệu)

        // Mở Modal (Cho cả Thêm và Sửa)
        function openModal() {
            // Reset form
            document.getElementById('flowerForm').reset();
            document.getElementById('flowerIndex').value = '';
            document.getElementById('modalTitle').innerText = 'Thêm hoa mới';
            flowerModal.show();
        }

        // Sửa hoa: Đổ dữ liệu vào form
        function editFlower(index) {
            const flower = flowers[index];
            document.getElementById('flowerIndex').value = index;
            document.getElementById('flowerName').value = flower.name;
            document.getElementById('flowerImage').value = flower.image;
            document.getElementById('flowerDesc').value = flower.description;
            
            document.getElementById('modalTitle').innerText = 'Chỉnh sửa thông tin hoa';
            flowerModal.show();
        }

        // Lưu hoa (Xử lý Thêm hoặc Cập nhật)
        function saveFlower() {
            const index = document.getElementById('flowerIndex').value;
            const name = document.getElementById('flowerName').value;
            const image = document.getElementById('flowerImage').value;
            const desc = document.getElementById('flowerDesc').value;

            // Validate đơn giản
            if(!name || !image) {
                alert('Vui lòng nhập tên và đường dẫn ảnh!');
                return;
            }

            const newFlowerData = {
                name: name,
                image: image,
                // Tạo fallback ảnh giả nếu user nhập link hỏng (cho demo)
                fallback: 'https://via.placeholder.com/300?text=No+Image', 
                description: desc
            };

            if (index === '') {
                // Thêm mới (Create)
                flowers.push(newFlowerData);
            } else {
                // Cập nhật (Update)
                flowers[parseInt(index)] = newFlowerData;
            }

            // Re-render và đóng modal
            renderGuest();
            renderAdmin();
            flowerModal.hide();
        }

        // Xóa hoa (Delete)
        function deleteFlower(index) {
            if(confirm('Bạn có chắc chắn muốn xóa loài hoa này không?')) {
                flowers.splice(index, 1);
                renderGuest();
                renderAdmin();
            }
        }
    </script>
</body>
</html>