@extends('frontend.template.master')


@section('title', 'Explore Exciting Advertise | Eversabz Advertise Listings')
@section('description', 'Explore diverse job opportunities with Eversabz. Find your perfect career match and apply
    today. Start your journey towards a fulfilling professional future!')

@section('content')

<style>
    .ads-container {
        max-width: 1280px;
        margin: 40px auto;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        padding: 0 15px;
    }

    .ad-card {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        text-align: center;
        padding: 20px;
        border: 2px solid #0044bb30;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .ad-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }

    .ad-card img {
        width: 100%;
        height: 200px;
        object-fit: contain;
        margin-bottom: 15px;
    }

    .ad-card h3 {
        font-size: 19px;
        font-weight: 500;
        color: #222;
        line-height: 1.75rem;
        margin-bottom: 12px;
        height: 2.8em;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: normal;
    }

    .ad-card button {
        background: transparent;
        border: 1.5px solid #007bff;
        color: #2d66b1;
        border-radius: 8px;
        padding: 8px 16px;
        font-size: 0.95rem;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .ad-card button:hover {
        background: #2d66b1;
        color: #fff;
    }

    @media (max-width: 768px) {
        .ads-container {
            grid-template-columns: repeat(2, 1fr);
        }
        .ad-card img {
            height: 150px;
        }
    }

    @media (max-width: 480px) {
        .ads-container {
            grid-template-columns: 1fr;
        }
        .ad-card {
            padding: 15px;
        }
    }

    .faq-section {
        max-width: 1300px;
        margin: 20px 60px 60px 143px;
        padding: 0 20px;
        font-family: "Inter", sans-serif;
    }

    .faq-item {
        background: #f9f9f9;
        border: 1px solid #e3e3e3;
        border-radius: 12px;
        margin-bottom: 15px;
        overflow: hidden;
        transition: all 0.3s ease;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.04);
    }

    .faq-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        cursor: pointer;
        padding: 18px 20px;
        font-size: 1.05rem;
        font-weight: 600;
        color: #222;
        background: #fff;
        transition: background 0.3s ease;
    }

    .faq-header:hover {
        background: #2773ba;
        color: #fff;
    }

    .faq-item.active .faq-header {
        background: #2773ba;
        color: #fff;
    }

    .faq-item.active .faq-icon{
        color: #fff;
    }

    .faq-icon {
        transition: transform 0.3s ease;
        font-size: 20px;
        color: #00a884;
    }

    .faq-body {
        max-height: 0;
        overflow: hidden;
        background: #fafafa;
        color: #555;
        font-size: 0.95rem;
        line-height: 1.6;
        padding: 0 20px;
        transition: all 0.35s ease;
    }

    .faq-item.active .faq-body {
        max-height: 500px;
        padding: 18px 20px;
    }

    .faq-item.active .faq-icon {
        transform: rotate(180deg);
    }

    @media (max-width: 768px) {
        .faq-header {
            font-size: 1rem;
        }

        .faq-section{
            margin: 20px 0;
        }
        h1 {
            font-size: 32px;
        }
        .faq-body {
            font-size: 0.9rem;
        }
    }
</style>

    <div class="py-5">
        <h1 class="text-center mb-3">Select a Direct Package to Send</h1>

        <div class="ads-container">
            <div class="ad-card">
                <img src="https://assets.aseelapp.com/cdn-cgi/image/width=400,format=auto,quality=90/https://assets.aseelapp.com/images/file_01JFEV7TCP6AV8FTKDPVNHAASX1200x1200.jpg" alt="Winter Kit">
                <h3>Winter Kit For Street Children</h3>
                <a href="{{ route('package.show', ['id' => 1]) }}" target="_blank">
                        <button>Send this $24.36 Package</button>
                </a>
            </div>

            <div class="ad-card">
                <img src="https://assets.aseelapp.com/cdn-cgi/image/width=400,format=auto,quality=90/https://assets.aseelapp.com/images/file_01JDXW18HCJPNQEFPYHDAFYPTY1200x1200.jpg" alt="Winter Coal Package">
                <h3>Winter Coal Package</h3>
                <button>Send this $116.00 Package</button>
            </div>

            <div class="ad-card">
                <img src="https://assets.aseelapp.com/cdn-cgi/image/width=400,format=auto,quality=90/https://assets.aseelapp.com/images/file_01HHYH44TYJ20XQJW79VT3HT2V1200x1200.jpg" alt="Emergency Wood Package">
                <h3>Emergency Wood Package For Families</h3>
                <button>Send this $139.20 Package</button>
            </div>

            <div class="ad-card">
                <img src="https://assets.aseelapp.com/cdn-cgi/image/width=400,format=auto,quality=90/https://assets.aseelapp.com/images/file_01JFM5E6HPSDX0H1YMK6J6A34K1200x1200.jpg" alt="Winter Heater Package">
                <h3>Winter Heater Package</h3>
                <button>Send this $58.00 Package</button>
            </div>
        </div>

        <h1 class="text-center py-3">Q&A</h1>

        <div class="faq-section">
            <div class="faq-item">
                <div class="faq-header">
                    <span>What is Aseel's DirectAid Beta?</span>
                    <span class="faq-icon">⌄</span>
                </div>
                <div class="faq-body">
                    Aseel's DirectAid Beta builds on Aseel's decentralized aid platform, which has served over 500,000 individuals since August 2021. It introduces Omid ID Cards for accurate beneficiary identification, the Atalan Network for on-the-ground support, and transparency via video documentation and emails. The process involves Send Aid, Track Aid, and receiving a distribution video for donors to witness the impact of their contribution.
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-header">
                    <span>How long does an aid delivery take?</span>
                    <span class="faq-icon">⌄</span>
                </div>
                <div class="faq-body">
                    It typically takes 24 to 48 working hours for the Atalan team to deliver an emergency package to the designated Omid ID holder across Afghanistan. However, the delivery can take longer sometimes due to unpredictable circumstances that are out of Aseel and Atalan's control.
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-header">
                    <span>How much does Aseel charge per delivery?</span>
                    <span class="faq-icon">⌄</span>
                </div>
                <div class="faq-body">
                    Aseel charges a flat fee of 10% of the package's price for each delivery.
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-header">
                    <span>How much is an Atal paid for a delivery?</span>
                    <span class="faq-icon">⌄</span>
                </div>
                <div class="faq-body">
                    Atalan payment depends on the type of Emergency Package delivery. For the delivery of a Small Emergency Food Package, an Atal is paid $3 to $5 for an Emergency Food Package or Emergency Child Relief Package, and $7 for the delivery of a Large Family Package.
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-header">
                    <span>What are the available DirectAid packages?</span>
                    <span class="faq-icon">⌄</span>
                </div>
                <div class="faq-body">
                    There are multiple emergency packages available that can be donated under the DirectAid Beta. The packages include a Large Family Food Package, an Emergency Small Food Package, an Emergency Package for Child, Emergency Food Package, an Emergency Baby Care Package, and Donate and Let Aseel Decide. Other packages will be added to the DirectAid packages based on the need. For instance, the Emergency Winter Package will be added in winter.
                </div>
            </div>
        </div>

        <script>

            document.querySelectorAll('.ad-card h3').forEach(title => {
                const text = title.textContent.trim();
                if (text.length > 70) {
                    title.textContent = text.slice(0, 70) + '...';
                }
            });

            document.querySelectorAll('.faq-header').forEach(header => {
                header.addEventListener('click', () => {
                    const item = header.parentElement;
                    item.classList.toggle('active');
                });
            });
        </script>
    </div>

@endsection