@extends('layouts.app')

@section('title', 'Kitoblar')

@section('content')
  <style>
    .book-viewer-container {
      max-width: 1400px;
      margin: 0 auto;
      padding: 20px;
    }

    #book-container {
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 700px;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      border-radius: 15px;
      padding: 40px;
      box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
    }

    #flipbook {
      box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
    }

    .page {
      background: white;
      display: flex;
      justify-content: center;
      align-items: center;
      border: 1px solid #ddd;
    }

    .page canvas {
      max-width: 100%;
      max-height: 100%;
      display: block;
    }

    .controls {
      display: flex;
      justify-content: center;
      align-items: center;
      gap: 30px;
      margin-top: 30px;
    }

    .btn-control {
      padding: 15px 35px;
      font-size: 18px;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: white;
      border: none;
      border-radius: 50px;
      cursor: pointer;
      transition: all 0.3s;
      box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
      font-weight: 600;
    }

    .btn-control:hover:not(:disabled) {
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(102, 126, 234, 0.6);
    }

    .btn-control:disabled {
      background: #ccc;
      cursor: not-allowed;
      box-shadow: none;
    }

    .page-info {
      font-size: 20px;
      color: #333;
      font-weight: 600;
      background: white;
      padding: 10px 25px;
      border-radius: 50px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .loading {
      text-align: center;
      padding: 100px;
      font-size: 24px;
      color: white;
      font-weight: 600;
    }

    .loading-spinner {
      border: 5px solid rgba(255, 255, 255, 0.3);
      border-top: 5px solid white;
      border-radius: 50%;
      width: 60px;
      height: 60px;
      animation: spin 1s linear infinite;
      margin: 20px auto;
    }

    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }

    /* Responsive */
    @media (max-width: 768px) {
      #book-container {
        padding: 20px;
      }

      .btn-control {
        padding: 12px 25px;
        font-size: 16px;
      }
    }
  </style>

  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <h1 class="page-title text-center mb-4">Kitoblar</h1>

        <div class="card shadow-lg border-0">
          <div class="card-body p-4">
            <div class="book-viewer-container">
              <div id="book-container">
                <div id="loading" class="loading">
                  <div class="loading-spinner"></div>
                  PDF yuklanmoqda...
                </div>
                <div id="flipbook" style="display: none;"></div>
              </div>

              <div class="controls">
                <button class="btn-control" id="prev-btn" disabled>
                  ← Oldingi
                </button>

                <div class="page-info">
                  <span id="current-page">0</span> / <span id="total-pages">0</span>
                </div>

                <button class="btn-control" id="next-btn">
                  Keyingi →
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- PDF.js -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>
  <script>
      pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js';
  </script>

  <!-- StPageFlip -->
  <script src="https://cdn.jsdelivr.net/npm/page-flip@2.0.7/dist/js/page-flip.browser.min.js"></script>

  <script>
      const url = "{{ route('books.show', 'sample.pdf') }}";
      const loading = document.getElementById('loading');
      const flipbookElement = document.getElementById('flipbook');
      const prevBtn = document.getElementById('prev-btn');
      const nextBtn = document.getElementById('next-btn');

      let pageFlip = null;
      let totalPages = 0;

      async function loadPDF() {
          try {
              const pdf = await pdfjsLib.getDocument(url).promise;
              totalPages = pdf.numPages;
              document.getElementById('total-pages').textContent = totalPages;

              // Barcha sahifalarni render qilish
              const pages = [];
              for (let pageNum = 1; pageNum <= totalPages; pageNum++) {
                  const page = await pdf.getPage(pageNum);

                  // Canvas yaratish
                  const canvas = document.createElement('canvas');
                  const context = canvas.getContext('2d');

                  // Viewport o'lchamini belgilash
                  const viewport = page.getViewport({ scale: 1.5 });
                  canvas.width = viewport.width;
                  canvas.height = viewport.height;

                  // Sahifani render qilish
                  await page.render({
                      canvasContext: context,
                      viewport: viewport
                  }).promise;

                  // Page div yaratish
                  const pageDiv = document.createElement('div');
                  pageDiv.className = 'page';
                  pageDiv.appendChild(canvas);
                  flipbookElement.appendChild(pageDiv);

                  pages.push(pageDiv);
              }

              // Loading yashirish
              loading.style.display = 'none';
              flipbookElement.style.display = 'block';

              // PageFlip ishga tushirish
              pageFlip = new St.PageFlip(flipbookElement, {
                  width: 550,  // Bir sahifa kengligi
                  height: 733, // Bir sahifa balandligi
                  size: 'stretch',
                  minWidth: 315,
                  maxWidth: 1000,
                  minHeight: 400,
                  maxHeight: 1350,
                  showCover: true,
                  mobileScrollSupport: true,
                  swipeDistance: 30,
                  clickEventForward: true,
                  usePortrait: true,
                  startPage: 0,
                  drawShadow: true,
                  flippingTime: 1000,
                  useMouseEvents: true,
                  autoSize: true,
                  maxShadowOpacity: 0.5,
                  showPageCorners: true,
                  disableFlipByClick: false
              });

              pageFlip.loadFromHTML(document.querySelectorAll('.page'));

              // Event listeners
              pageFlip.on('flip', (e) => {
                  updatePageInfo();
              });

              updatePageInfo();

          } catch (error) {
              console.error('Xato:', error);
              loading.innerHTML = '<div style="color: white;">PDF faylni yuklashda xatolik yuz berdi!</div>';
          }
      }

      function updatePageInfo() {
          const currentPage = pageFlip.getCurrentPageIndex() + 1;
          document.getElementById('current-page').textContent = currentPage;

          prevBtn.disabled = currentPage === 1;
          nextBtn.disabled = currentPage >= totalPages;
      }

      // Button event listeners
      prevBtn.addEventListener('click', () => {
          pageFlip.flipPrev();
      });

      nextBtn.addEventListener('click', () => {
          pageFlip.flipNext();
      });

      // Keyboard navigation
      document.addEventListener('keydown', (e) => {
          if (e.key === 'ArrowLeft') {
              pageFlip.flipPrev();
          } else if (e.key === 'ArrowRight') {
              pageFlip.flipNext();
          }
      });

      // PDF yuklash
      loadPDF();
  </script>
@endsection
