<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<div class="bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Daftar Lokasi Arsip</h2>

    <div class="flex justify-between items-center mb-4 flex-wrap gap-2">
        <?php if (session('role') === 'admin') : ?>
        <a href="<?= base_url('admin/lokasi/tambah') ?>"
            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium transition duration-300">
            <i class="fas fa-plus-circle mr-1"></i> Tambah Lokasi
        </a>
        <?php endif; ?>

        <div class="flex gap-2">
            <input type="text" id="searchInput" placeholder="Cari perihal atau nomor surat..."
                class="border px-3 py-2 rounded-md text-sm" onkeyup="filterTable()">
            <select id="jenisFilter" class="border px-3 py-2 rounded-md text-sm" onchange="filterTable()">
                <option value="">Semua Jenis</option>
                <option value="Surat Masuk">Surat Masuk</option>
                <option value="Surat Keluar">Surat Keluar</option>
            </select>
            <select id="sortColumn" class="border px-3 py-2 rounded-md text-sm" onchange="sortTable()">
                <option value="">Urutkan</option>
                <option value="0">No</option>
                <option value="1">Nama Box</option>
                <option value="2">Nomor Rak</option>
                <option value="3">Jenis Surat</option>
            </select>
        </div>
    </div>

    <!-- Tombol Export -->
    <div class="flex gap-2 mb-4">
        <button onclick="exportToPDF()"
            class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md text-sm font-medium transition duration-300">
            <i class="fas fa-file-pdf mr-1"></i> Cetak PDF
        </button>
        <button onclick="exportToExcel()"
            class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md text-sm font-medium transition duration-300">
            <i class="fas fa-file-excel mr-1"></i> Export Excel
        </button>
    </div>

    <?php if (session()->getFlashdata('success')) : ?>
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
        <strong class="font-bold">Sukses!</strong>
        <span class="block sm:inline"><?= esc(session()->getFlashdata('success')) ?></span>
    </div>
    <?php endif; ?>

    <div class="overflow-x-auto">
        <table id="lokasiTable" class="min-w-full bg-white border border-gray-200 rounded-lg">
            <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left cursor-pointer" onclick="sortTable(0)">No <i
                            class="fas fa-sort ml-1"></i></th>
                    <th class="py-3 px-6 text-left cursor-pointer" onclick="sortTable(1)">Nama Box <i
                            class="fas fa-sort ml-1"></i></th>
                    <th class="py-3 px-6 text-left cursor-pointer" onclick="sortTable(2)">Nomor Rak <i
                            class="fas fa-sort ml-1"></i></th>
                    <th class="py-3 px-6 text-left cursor-pointer" onclick="sortTable(3)">Jenis Surat <i
                            class="fas fa-sort ml-1"></i></th>
                    <th class="py-3 px-6 text-left">Nomor Surat</th>
                    <th class="py-3 px-6 text-left">Perihal</th>
                    <th class="py-3 px-6 text-left">Lampiran</th>
                    <?php if (session('role') === 'admin') : ?>
                    <th class="py-3 px-6 text-center">Aksi</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody class="text-gray-700 text-sm font-light">
                <?php $no = 1; ?>
                <?php foreach ($lokasi as $row) : ?>
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="py-3 px-6 text-left"><?= $no++ ?></td>
                    <td class="py-3 px-6 text-left"><?= esc($row['nama_box']) ?></td>
                    <td class="py-3 px-6 text-left"><?= esc($row['nomor_rak']) ?></td>
                    <td class="py-3 px-6 text-left jenis-surat">
                        <?= $row['idsuratkeluar'] ? 'Surat Keluar' : ($row['idsuratmasuk'] ? 'Surat Masuk' : '-') ?>
                    </td>
                    <td class="py-3 px-6 text-left nomor-surat">
                        <?= esc($row['idsuratkeluar']
                                ? ($row['no_surat_keluar'] ?? '-')
                                : ($row['no_surat_masuk'] ?? '-')) ?>
                    </td>
                    <td class="py-3 px-6 text-left perihal">
                        <?= esc($row['idsuratkeluar']
                                ? ($row['perihal_keluar'] ?? '-')
                                : ($row['perihal_masuk'] ?? '-')) ?>
                    </td>
                    <td class="py-3 px-6 text-left">
                        <?php if (!empty($row['idsuratkeluar'] ? $row['lampiran_keluar'] : $row['lampiran_masuk'])) : ?>
                        <a href="<?= base_url('uploads/' . ($row['idsuratkeluar'] ? 'suratkeluar/' . $row['lampiran_keluar'] : 'suratmasuk/' . $row['lampiran_masuk'])) ?>"
                            target="_blank" class="text-blue-500 hover:underline">
                            Lihat
                        </a>
                        <?php else : ?>
                        -
                        <?php endif; ?>
                    </td>
                    <?php if (session('role') === 'admin') : ?>
                    <td class="py-3 px-6 text-center">
                        <div class="flex item-center justify-center">
                            <a href="<?= base_url('admin/lokasi/edit/' . $row['id']) ?>"
                                class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110 text-blue-600">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="<?= base_url('admin/lokasi/delete/' . $row['id']) ?>"
                                onclick="return confirm('Yakin hapus data ini?')"
                                class="w-4 mr-2 transform hover:text-red-500 hover:scale-110 text-red-600">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                        </div>
                    </td>
                    <?php endif; ?>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- JS CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

<!-- JS Logika Table -->
<script>
let currentSortColumn = null;
let sortDirection = 1;

function filterTable() {
    const input = document.getElementById("searchInput").value.toLowerCase();
    const jenis = document.getElementById("jenisFilter").value;
    const rows = document.querySelectorAll("#lokasiTable tbody tr");

    rows.forEach(row => {
        const jenisText = row.querySelector(".jenis-surat").textContent.trim();
        const perihal = row.querySelector(".perihal").textContent.toLowerCase();
        const nomor = row.querySelector(".nomor-surat").textContent.toLowerCase();

        const matchSearch = perihal.includes(input) || nomor.includes(input);
        const matchJenis = jenis === "" || jenisText === jenis;

        row.style.display = matchSearch && matchJenis ? "" : "none";
    });
}

function sortTable(columnIndex = null) {
    if (columnIndex !== null) {
        if (currentSortColumn === columnIndex) {
            sortDirection *= -1;
        } else {
            currentSortColumn = columnIndex;
            sortDirection = 1;
        }
    }

    const table = document.getElementById("lokasiTable");
    const tbody = table.querySelector("tbody");
    const rows = Array.from(tbody.querySelectorAll("tr"));

    rows.sort((a, b) => {
        const aValue = a.cells[currentSortColumn].textContent.trim();
        const bValue = b.cells[currentSortColumn].textContent.trim();
        if (currentSortColumn === 0 || currentSortColumn === 2) {
            return (parseInt(aValue) - parseInt(bValue)) * sortDirection;
        }
        return aValue.localeCompare(bValue) * sortDirection;
    });

    while (tbody.firstChild) {
        tbody.removeChild(tbody.firstChild);
    }
    rows.forEach(row => tbody.appendChild(row));
    updateSortIndicators();
}

function updateSortIndicators() {
    const headers = document.querySelectorAll("#lokasiTable th");
    headers.forEach((header, index) => {
        header.innerHTML = header.textContent.trim() + ' <i class="fas fa-sort ml-1"></i>';
    });

    if (currentSortColumn !== null) {
        const activeHeader = headers[currentSortColumn];
        const icon = sortDirection === 1 ? 'fa-sort-up' : 'fa-sort-down';
        activeHeader.innerHTML = activeHeader.textContent.trim() + ` <i class="fas ${icon} ml-1"></i>`;
    }
}

document.addEventListener('DOMContentLoaded', updateSortIndicators);

function exportToPDF() {
    const element = document.getElementById("lokasiTable");
    const opt = {
        margin: 0.5,
        filename: 'daftar-lokasi-arsip.pdf',
        image: {
            type: 'jpeg',
            quality: 0.98
        },
        html2canvas: {
            scale: 2
        },
        jsPDF: {
            unit: 'in',
            format: 'a4',
            orientation: 'landscape'
        }
    };
    html2pdf().from(element).set(opt).save();
}

function exportToExcel() {
    const table = document.getElementById('lokasiTable');
    const wb = XLSX.utils.table_to_book(table, {
        sheet: "Lokasi Arsip"
    });
    XLSX.writeFile(wb, 'daftar-lokasi-arsip.xlsx');
}
</script>

<?= $this->endSection() ?>