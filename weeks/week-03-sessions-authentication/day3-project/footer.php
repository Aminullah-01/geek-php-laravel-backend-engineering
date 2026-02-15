
    </main>

    <footer class="site-footer" role="contentinfo">
        <div class="footer-inner">
            <div class="footer-left">
                <strong>Geek Auth</strong>
                <span class="sep">•</span>
                <span class="muted">Sessions & Authentication</span>
            </div>

            <div class="footer-right">
                <span class="muted">© <?= date('Y') ?></span>
            </div>
        </div>
    </footer>

    <style>
        .site-footer{
            border-top: 1px solid rgba(255,255,255,.10);
            background: rgba(11,18,32,.55);
            backdrop-filter: blur(10px);
        }
        .footer-inner{
            max-width: 1080px;
            margin: 0 auto;
            padding: 16px;
            display: flex;
            gap: 12px;
            align-items: center;
            justify-content: space-between;
        }
        .footer-left{
            display: flex;
            align-items: center;
            gap: 10px;
            color: rgba(255,255,255,.90);
            font-size: 14px;
        }
        .footer-right{
            font-size: 14px;
        }
        .muted{ color: rgba(255,255,255,.65); }
        .sep{ color: rgba(255,255,255,.25); }
    </style>
</body>
</html>