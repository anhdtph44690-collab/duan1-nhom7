-- Thêm cột departure_date vào bảng bookings nếu chưa có
ALTER TABLE bookings ADD COLUMN departure_date DATE AFTER people_count;
