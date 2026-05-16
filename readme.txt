=== NFD Flash Sale ===
Contributors: newfolder
Tags: flash sale, countdown, timer, banner, woocommerce
Requires at least: 5.0
Tested up to: 6.4
Stable tag: 1.0.12
Requires PHP: 7.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Plugin สำหรับสร้าง Flash Sale Banner พร้อมระบบ Countdown Timer ที่ด้านล่างหน้าจอ ปรับแต่งได้อิสระสำหรับ PC และ Mobile รองรับปุ่ม CTA แบบ Floating และ Bottom Bar.

== Description ==

NFD Flash Sale เป็นปลั๊กอินสำหรับแสดงป้ายประกาศ (Banner) สไตล์ Flash Sale หรือแคมเปญต่างๆ โดยมีจุดเด่นคือจะแสดงอยู่บริเวณขอบล่างของหน้าจอ พร้อมระบบเวลานับถอยหลัง (Countdown Timer) และปุ่ม Call-To-Action (CTA) ที่รองรับการคลิกเพื่อแชทผ่าน LINE, Facebook Messenger, หรือโทรศัพท์ 

**ฟีเจอร์เด่น:**
* **Responsive 100%:** แยกการอัปโหลดรูปภาพและกำหนดการจัดวาง (Position) สำหรับ PC และ Mobile ออกจากกันอย่างสมบูรณ์
* **Drag & Drop Preview:** หน้าจัดการแอดมินมาพร้อมระบบ Live Preview แบบลาก-วาง เพื่อจัดเรียงตัวเลขนับถอยหลังบนแบนเนอร์ได้อย่างแม่นยำ
* **Customizable Styles:** สามารถกำหนดสี ขนาดตัวอักษร กรอบตัวเลข และการแสดงผลแยกกันระหว่างอุปกรณ์ PC และ Mobile
* **Floating & Bottom CTAs:** รองรับการใส่ปุ่ม CTA ลอยตัวและปุ่มเรียงด้านล่างแบบเต็มจอ 
* **Native Icon Support:** รองรับไอคอนในตัว (LINE, Messenger, Facebook, Phone, Cart) หรืออัปโหลดไอคอนของคุณเอง
* **Auto Loop Timer:** ระบบรีเซ็ตเวลานับถอยหลังอัตโนมัติตามชั่วโมงที่กำหนด 

ปลั๊กอินนี้พัฒนาโดยทีมงาน [Newfolder](https://newfolder.co.th)

== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/nfd-flashsale` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress.
3. Use the `NFD Flash Sale` menu to add your first Flash Sale banner.

== Frequently Asked Questions ==

= แบนเนอร์ไม่แสดงบนหน้าเว็บ? =
ตรวจสอบว่าคุณตั้งค่าสถานะเป็น "Active" (เปิดใช้งาน) และได้เลือก "Target Pages" ให้ตรงกับหน้าที่ต้องการแสดงแล้ว

= ภาพบนมือถือถูกตัด? =
แนะนำให้อัปโหลดภาพแนวตั้ง (Portrait) หรือสี่เหลี่ยมจัตุรัสสำหรับช่อง "Mobile Image" โดยเฉพาะ เพื่อให้เหมาะสมกับหน้าจอมือถือ

== Screenshots ==

1. screenshot-1.jpg
2. screenshot-2.jpg

== Changelog ==

= 1.0.12 =
* แยกการตั้งค่าสี, พื้นหลัง, ขนาดตัวเลข และระยะห่าง สำหรับ PC และ Mobile อย่างอิสระ
* เปลี่ยนไอคอนเป็นระบบ SVG Native เพื่อความเร็วและลดปัญหากับ FontAwesome
* เพิ่ม `target="_blank"` สำหรับการกดลิงก์ทั้งหมด
* เพิ่มอนิเมชันปุ่ม CTA ให้ดูเป็นธรรมชาติและเรียบหรูขึ้น

= 1.0.10 =
* เพิ่มฟังก์ชัน Drag & Drop ใน Live Preview
* เพิ่มการปรับปุ่ม Floating 
* เพิ่มปุ่ม Bottom CTAs
