<?php
    session_start();

    if($_SERVER["SERVER_NAME"] == 'localhost' || $_SERVER["SERVER_NAME"] == '127.0.0.1'){
      require $_SERVER['DOCUMENT_ROOT'] . "/acs-groups/backoffice/acs-project/config/app.php";
    }else{
        require $_SERVER['DOCUMENT_ROOT'] . "/backoffice/acs-project/config/app.php";
    }
    
    include_once('./Controllers/Auth/LoginController.php');

    $auth = new LoginController();
    use App\Models\Template;

    if(!($_SESSION['authenticated'])){  
        $auth->redirect('./login.php');
    }
    else {

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Presentation</title>
  <meta name="description" content="" />
  <!-- Favicon -->
  <link rel="apple-touch-icon" sizes="180x180" href="./assets/img/favicons/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="./assets/img/favicons/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="./assets/img/favicons/favicon-16x16.png">
  <link rel="manifest" href="./assets/img/favicons/site.webmanifest">
  <link rel="mask-icon" href="./assets/img/favicons/safari-pinned-tab.svg" color="#5bbad5">
  <meta name="msapplication-TileColor" content="#b8ebfa">
  <meta name="theme-color" content="#b8ebfa">

  <link rel="stylesheet" href="./assets/css/present.css">
  <link rel="stylesheet" href="./assets/static/css/webslides.css">

</head>

<body>
  <main role="main">
    <article id="webslides" class="horizontal">
      <section>
        <span class="background" style="background-image:url('./assets/img/presentations/p1.jpg')"></span>

        <div class="wrap">
          <h1 class="text-topic">
            <strong>
              Arun Chaiseri Consulting Engineers <br>
              Group Of Company
            </strong>
          </h1>

          <div class="logo">
            <img src="./assets/img/acs/acs-logo.png" alt="ACSLogo">
          </div>
        </div>
      </section>


      <section class="tm">
        <div class="tm-box">
          <div class="tm-row">
            <div class="tm-column">
              <img src="./assets/img/acs/tuk-chang.jpeg" alt="CompanyProfile">
            </div>      
            <div class="tm-column2">
              <div>
                <h1><b>Company Profile</b></h1>
                <p>
                  Arun Chaiseri Group of Companies was established to provide full scope of building and construction consultancy. 
                  It was originated from Arun Chaiseri Consulting Engineers Company Limited which was founded in 1979 
                  by Professor Arun Chaiseri, a professor emeritus of the Faculty of Civil Engineering, Chulalongkorn University, 
                  Bangkok, Thailand. “Arun Chaiseri Consulting Engineers” started our services of structural engineering design for 
                  various building projects of private and government sectors. Prior to the establishment, Professor Arun Chaiseri 
                  performed structural engineering design for several renowned buildings in Thailand such as “The Assemble Hall of the 
                  Parliament of Thailand, Royal Cliff Beach Resort Pattaya and more than 50 academic buildings in many universities all 
                  over Thailand. Vast experience of “Arun Chaiseri Consulting Engineers” was accumulated from Professor Arun’s personal 
                  participation of more than 400 projects during this period.    
                </p>
              </div>
              <div class="hr"></div> 
            </div>     
          </div>                
        </div>
        <img src="./assets/img/acs/acs-logo.png" alt="ACSLogo" class="logo-tm">
      </section>
      

      <section class="tm">
        <div class="tm-box">
          <div class="tm-row">
            <div class="tm-column">
              <img src="./assets/img/acs/tuk-chang.jpeg" alt="CompanyProfile">
            </div>      
            <div class="tm-column2">
              <div>
                <h1><b>Company Profile</b></h1>
                <p>
                  Our company has continuous growth over the past 40 years with more than 200 qualified and 
                  experienced staffs conducting various project consultancy from Project management, Construction 
                  supervision, Architectural and Engineering design, Cost management, Quantity Survey, Feasibility study, 
                  Energy Auditing and Conservation to Facility Management. Arun Chaiseri Consulting Engineers has been 
                  providing consulting services for more than 1,000 projects as well as expanding its consultancy business to 
                  cover every aspect of construction. In order to gain more efficiency of the services, The Arun Chaiseri
                  Group of Companies was established and each Business Unit was strengthened and deepened its expertise 
                  in the relevant technology whilst coordinate firmly among the affiliation of group so as to provide in 
                  Absolute Consultancy Solutions for the benefit of our client with our supreme legacy service and the 
                  newest available technology.
                </p>
              </div>
              <div class="hr"></div> 
            </div>     
          </div>                
        </div>
        <img src="./assets/img/acs/acs-logo.png" alt="ACSLogo" class="logo-tm">
      </section>      



      <section class="bg-slide">
        <h2 class="title">Scope of Consulting Services</h2>
        
        <div class="wrapper">
          <div class="container-box">
            <div class="box">
              <img src="./assets/img/acs/c2.png">
              <h3>Structural and Civil Engineering Design</h3>
            </div>
            <div class="box">
              <img src="./assets/img/acs/en1.png">
              <h3>Project Management</h3>
            </div>
            <div class="box">
              <img src="./assets/img/acs/icon-e8.png">
              <h3>Construction Management and Supervision</h3>
            </div>
            <div class="box">
              <img src="./assets/img/acs/b1.png">
              <h3>Mechanical, Electrical, and Sanitary Engineering Design</h3>
            </div>
          </div>
        </div> 
      </section>
      
     
      <section>
        <span class="background" style="background-image:url('https://img.freepik.com/premium-photo/working-woman_36367-6592.jpg?w=900')"></span>
        <h2 class="title-second">Structural and Civil Engineering Design</h2>
      </section>


      <section class="bg-slide">
          <h2 class="sub-title">Structural and Civil Engineering Design</h2>
          <div class="wrap">
            <div class="card">
              <p class="text-content">
                &nbsp; &nbsp; &nbsp; Covers the Analysis and Detailed Design of Structural and Civil Engineering ; Geo-technical Engineering; 
                Structural Damage Investigation; <br>
                Due Diligence Services; and Independent Checking Engineering. <br>
                <b>In brief, we shall deliver the following services to the Client.</b> <br>
                • Recommendations of the Foundations, e.g. sizes and types of foundations and piles. <br>
                • Foundation Analysis and Design, e.g. mat foundation, pile cap, combined footing. <br>
                • Structural Analysis of Building Elements. <br>
                • Building Element Detailed Design. <br>
                • Wind and Lateral Load Resistant Analysis of the Overall Structural System <br>
                • Civil engineering design of roads, walkways and fences outside the building. <br>
                • Provide engineering design support for landscape works within the project site area. <br>
              </p>
            </div>
          </div>
      </section>

      
      <section>
        <span class="background" style="background-image:url('https://img.freepik.com/premium-photo/rear-view-engineer-building-site-examines-blueprints_454047-5039.jpg')"></span>
        <h2 class="title-second">Project Management</h2>
      </section>


      <section class="bg-slide">
          <h2 class="sub-title">Project Management</h2>
          <div class="wrap">
            <div class="card">
              <p class="text-content">
                &nbsp; &nbsp; &nbsp; Covers Project Feasibility Study; Master Plan Study ; Project Planning and Schedule Management; 
                Project Control; Project Cost Management; Contractor Procurement; Contract Management; Design Coordination; and Design Management.
                The Project Management Consultant (PMC) shall mainly be responsible for the activities during 
                pre-construction phase, i.e. design and bidding processes. <br>
                <b>In brief, we shall deliver the following services to the Client.</b> <br>
                • Study all requirements from the owner to understand their objectives and prepare the Project Master Schedule. <br>
                • Project Approach and Management Setup. <br>
                • Program Management and Project Control. <br>
                • Project Cost Management. <br>
                • Procurement Management of contractors. <br>
                • Contract Management of contractors. <br>
                • Project Coordination and Design Management in order that all design works are fully completed <br> 
                according to the scheduled plan
              </p>
            </div>
          </div>
      </section>


      <section class="bg-slide">
          <h2 class="sub-title">Project Management</h2>
          <div class="wrap">
            <div class="card">
              <p class="text-content">
              • Organize and chair technical and follow-up meetings during design and bidding processes for once a week. <br>
              • Organize and chair project management meetings during design and bidding processes for at least once a month. <br>
              • Prepare monthly progress report and other required documents for the Owner during design and bidding processes. <br>
              • Attend monthly project site meetings during construction phase. <br>
              • Prepare executive summary report for the Owner every 3 months during construction phase. <br>
              <b>Scope of VALUE ENGINEERING service include:</b> <br>
              • Analysis & Selection of Possible Alternative <br>
              • Facts Finding & Analysis <br>
              • Comparative Analysis of Each Alternative <br>
              • Pros. & Cons. Analysis <br>
              • Comments & Recommendation for Decision Makin <br>
              </p>
            </div>
          </div>
      </section>


      <section>
        <span class="background" style="background-image:url('https://img.freepik.com/free-photo/smart-asian-engineer-manager-with-safety-uniform-checking-site-construction-with-steel-concrete-sturcture-background_609648-1627.jpg?w=1060&t=st=1669881881~exp=1669882481~hmac=be418cc35f1784b5a11241e3df0e16402a411049f594a12b30283ede80cd07d6')"></span>
        <h2 class="title-second">Construction Management and Supervision</h2>
      </section>


      <section class="bg-slide">
        <h2 class="sub-title">Construction Management and Supervision</h2>
        <div class="wrap">
          <div class="card">
            <p class="text-content">
            &nbsp; &nbsp; &nbsp; To achieve the most efficient scheme regarding Time, Quality and Budget, Construction 
            Management or CM plays an important role during construction stage. Our services start from Construction 
            Cost Estimation; Contractor Bidding Process; Contract Preparation and Contract Management; Construction 
            Planning and Scheduling; Construction Supervision; and Quantity Surveying Services (Q.S.).<br>
            <b>In brief, we shall deliver the following services to the Client.</b> <br>
            • Study all requirements from the owner to understand their objectives and prepare the Construction Schedule. <br>
            • Study thoroughly the detailed design drawings and specifications in order to achieve the most efficient schemes 
            as regards construction procedure and schedule. <br>
            • Pre-qualify contractors and suppliers by preparing a suitable tender list of contractors/suppliers, checking references and resource capability. <br>
            • Advising on tender procedures and participating in interviews, together with the Client and design team as appropriate. <br>
            </p>
          </div>
        </div>
      </section>

 
      <section class="bg-slide">
        <h2 class="sub-title">Construction Management and Supervision</h2>
        <div class="wrap">
          <div class="card">
            <p class="text-content">
              • Conduct tendering process, tender evaluation and contractual document preparation for all 
              construction and procurement contracts. <br>
              • Assist in negotiation of tenders and recommend award of the contracts. <br>
              • Provide daily inspection to the construction and installation activities. Supervise and control the 
              quality, cost and safety of the construction works to ensure that they are executed in accordance 
              with the contract drawings and specifications and most importantly the owner's requirements. <br>
              • Analyze the work procedures by a proactive approach, detect the upcoming problems/delays and 
              advise solutions to overcome problems/delays. <br>
              • Perform a Client representative’s role in inspection of equipment and material testing, 
              commissioning test run and advise the substantial completion of the contracts. <br>
              • Ascertain and determine the quality of work and measure the value of executed work for payment 
              purpose <br>
            </p>
          </div>
        </div>
      </section>

      
      <section class="bg-slide">
        <h2 class="sub-title">Construction Management and Supervision</h2>
        <div class="wrap">
          <div class="card">
            <p class="text-content">
              • Organize and chair Project Meetings including site weekly meeting and monthly review meetings. 
              Also prepare all necessary documents. <br>
              • Supervise the modification of the project program in case of delay to the intermediate milestone. <br>
              • Advise the completion of work for each payment. <br>
              • Provide a periodical work inspection until the end of guaranteed period <br>
            </p>
          </div>
        </div>
      </section>


      <section>
        <span class="background" style="background-image:url('https://img.freepik.com/free-photo/crop-architect-opening-blueprint_23-2147710985.jpg?w=1060&t=st=1669882049~exp=1669882649~hmac=75fbb77dbc8813d9256f6e2de4cb14aee0a3c81725254869b78aaafb4b9bb30c')"></span>
        <h2 class="title-second">Mechanical, Electrical, and Sanitary Engineering Design</h2>
      </section>

        
      <section class="bg-slide">
        <h2 class="sub-title">Mechanical, Electrical, and Sanitary Engineering Design</h2>
        <div class="wrap">
          <div class="card">
            <p class="text-content">
              &nbsp; &nbsp; &nbsp; Services include Detailed Engineering Design of Electrical; HVAC; Sanitary; Waste Treatment; Fire 
              Protection; Elevator and Escalation System; Intelligent Building System; Building Automation System; 
              Industrial Piping; Communication; Security; and IT System. <br>
              &nbsp; &nbsp; &nbsp; <b>Mechanical Engineering Design</b> <br>
              • Air-condition System <br>
              • Air Distribution System <br>
              • Ventilation System <br>
            </p>
          </div>
        </div>
      </section>


      <section class="bg-slide">
        <h2 class="sub-title">Mechanical, Electrical, and Sanitary Engineering Design</h2>
        <div class="wrap">
          <div class="card">
            <p class="text-content">
              &nbsp; &nbsp; <b>Electrical Engineering Design</b><br>
              • Electrical Power Substation <br>
              • Standby Power Generator <br>
              • Power Distribution <br>
              • Lighting (including wiring for interior lighting) <br>
              • Fire Monitoring and Alarm <br>
              • Telephone and PABX <br>
              • Sound (Background Music/Paging) <br>
              • Master Antenna System/Satellite TV. <br>
              • Grounding <br>
              • Lightning Protection System <br>
              • Security System <br>
            </p>
          </div>
        </div>
      </section>


      <section class="bg-slide">
        <h2 class="sub-title">Mechanical, Electrical, and Sanitary Engineering Design</h2>
        <div class="wrap">
          <div class="card">
            <p class="text-content">
              &nbsp; &nbsp; <b>Sanitary Engineering Design</b><br>
              • Cold & Hot Water Supply System <br>
              • Storm Drainage System <br>
              • Wastewater Treatment System <br>
              • Water System for Landscaping Features <br><br>
              &nbsp; &nbsp; <b>Fire Protection System Design</b><br>
              • Water Sprinkler System <br>
              • Water Storage & Fire Pumps <br>
              • Hose and Hydrant Systems <br>
              • Portable Extinguishers <br>
            </p>
          </div>
        </div>
      </section>


      <section>
        <span class="background" style="background-image:url('https://img.freepik.com/free-photo/image-engineering-objects-workplace-top-view-construction-concept-engineering-tools-vintage-tone-retro-filter-effect-soft-focus-selective-focus_1418-474.jpg?w=1060&t=st=1669882736~exp=1669883336~hmac=7323eaa83c1c10ee8427ddbd379c858d379022e8f9057eadd660e926dbe1573d')"></span>
        <h2 class="title-second">Architectural, Interior Decoration, and Landscape Design</h2>
      </section>


      <section class="bg-slide">
        <h2 class="sub-title">Architectural, Interior Decoration, and Landscape Design</h2>
        <div class="wrap">
          <div class="card">
            <p class="text-content">
              Services include Master Plan Layout; Detailed Design and Supervision of 
              Architectural, Interior, and Landscape Works during construction phase.
            </p>
          </div>
        </div>
      </section>


      <section>
        <span class="background" style="background-image:url('https://images.unsplash.com/photo-1581094478420-48afc75f4e5d?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80')"></span>
        <h2 class="title-second">Value Engineering</h2>
      </section>


      <section class="bg-slide">
        <h2 class="sub-title">Value Engineering</h2>
        <div class="wrap">
          <div class="card">
            <p class="text-content">
              <b>Scope of VALUE ENGINEERING service include:</b> <br>
                Study all relevant project’s information and the Owner’s requirements for value engineering operation <br>
                • Expectations for success of value engineering operation <br>
                • Concepts of the project development and design <br>
                • Building operation categories <br>
                • Project budget <br>
                • Project planning and schedule <br>
                • Owner’s requirements <br>
                • Future expansion <br>
                • Relevant limitations <br>
                • Complete project construction drawings (according to the ongoing project situation) <br>
                • Other relevant information <br>
            </p>
          </div>
        </div>
      </section>


      <section class="bg-slide">
        <h2 class="sub-title">Value Engineering</h2>
        <div class="wrap">
          <div class="card">
            <p class="text-content">
              • Inspect, review and analyze the complete construction drawings in order to collect relevant 
              issues and be prepared for the value engineering operation. <br>
              • Perform value engineering to propose lists of drawings which should be adjusted to achieve 
              worthier alternative(s). <br>
              • Prepare value engineering reports including proposed alternatives in adjusting construction 
              drawings, value engineering comparative issues, and estimation of possible diminution of costs. 
              These shall be proposed to the Owner to prepare operation meeting, from which findings can 
              be obtained. <br>
              • Prepare value engineering operation meeting in conjunction with the Owner, value engineering 
              team, designer and construction supervisor to brainstorm the ideas of improving construction 
              drawings creatively and beneficially. Nevertheless, modification of project planning shall be 
              avoided. <br>
              • Prepare lists of construction drawing adjustments as summarized from every operation meeting 
              in order to monitor the drawing adjustments efficiently. <br>
              • Prepare summary reports from value engineering operation <br>
            </p>
          </div>
        </div>
      </section>


      <section>
        <span class="background" style="background-image:url('https://img.freepik.com/premium-photo/engineers-checking-blueprint-details_274689-8597.jpg?w=1060')"></span>
        <h2 class="title-second">Quantity Surveying (Q.S.)</h2>
      </section>


      <section class="bg-slide">
        <h2 class="sub-title">Quantity Surveying (Q.S.)</h2>
        <div class="wrap">
          <div class="card">
            <p class="text-content">
              <b>Scope of QUANTITY SURVEYING (Q.S.) service include:</b> <br>
              • To assist the Owner to review the Design and Contract Documentation prior to issuing to the 
              contractors. <br>
              • To assess and check the breakdown of the Contractor’s price and rates in order to finalise a 
              Lump Sum Price under the Contract, include review of drawings, cost estimates, sub-contract 
              tenders, proposed programme or other documents used in the preparation of the Lump Sum 
              Contract. <br>
              • To comment on the cost aspect in relation to any option, alternative or qualification in the 
              Contractor’s proposal. <br>
              • To establish a financial reporting system for the Owner to continuously monitor the cost of the 
              project at all times during development programme. <br>
              • Examine the cash flow forecast for comment or approval. <br>
              • Review the project performance bonds and contract insurance requirements to ensure 
              compliance with the contract requirements. <br>
            </p>
          </div>
        </div>
      </section>


      <section class="bg-slide">
        <h2 class="sub-title">Quantity Surveying (Q.S.)</h2>
        <div class="wrap">
         <div class="card">
          <p class="text-content">
              • To carry out cost checks on estimates and other information supplied by the Contractor and 
              his Subcontractors, Suppliers, etc. in respect of scope changes requested by the Owner or the 
              Contractor. <br>
              • To assess variation claims submitted by the Contractor and advise the Owner on the financial 
              implications associated with the claims prior to approval/disapproval. <br>
              • Review tenders received for M&E and Equipment and advise on the cost implications relative 
              to the original budget. <br>
              • To prepare and agree interim valuations at milestone points in the construction process with 
              the Contractor and make recommendations for payment. <br>
              • Provide monthly financial statements. <br>
            </p>
         </div>
        </div>
      </section>


      <section class="bg-slide">
        <h2 class="sub-title">Quantity Surveying (Q.S.)</h2>
        <div class="wrap">
          <div class="card">
            <p class="text-content">
              • To advise and assist the Owner in handling all contractual matters. <br>
              • To review and agree the final account with the Contractor after the completion of the project. <br>
              • Attend co-ordination and site meetings as necessary. <br>
              • Liase with Owner to ensure correct interpretation of their requirement with regard to the 
              provision of all Equipment. <br>
              • Participate in value engineering reviews to identify savings. <br> <br>
              “Arun Chaiseri Consulting Engineers” has been introducing the new innovation to the 
              building design and construction in Thailand as referenced by the following famous projects.
            </p>
          </div>
        </div>
      </section>


      <section>
        <span class="background" style="background-image:url('https://images.unsplash.com/photo-1429497419816-9ca5cfb4571a?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1171&q=80')"></span>
        <h2 class="title-second">Our Outstanding Experiences</h2>
      </section>


      <section class="bg-slide">
        <h2 class="sub-title">Our Outstanding Experiences</h2>
        <div class="wrap">
          <div class="card">
            <p class="text-content">
              &nbsp; &nbsp; <b>In 1979</b> – We introduced the Deep and Large Diameter Bored Piles for the first time in 
              Thailand in the construction of “Royal Orchid Sheraton Hotel”, which is among the very first high-rise 
              structure in Bangkok. <br>
              &nbsp; &nbsp; <b>In 1985</b> – We designed the first ultra-deep building structure in Thailand of 18 meters by 
              applying Diaphragm Wall and Top-down Construction Technique to “The Grand China Tower”. The 
              building has the total of six basements. <br>
              &nbsp; &nbsp; <b>In 1983</b>, A 42-story Baiyoke Tower sprang up higher than other high-rise structures in Bangkok 
              and, in 1988, A 84-story Baiyoke Tower II was designed to surpass the height of Baiyoke Tower and 
              became Thailand’s tallest structure ever since with its total height of 310 meters. Many structural 
              design technologies were implemented for the first time, including Frame-Tube Structure and 
              Diagonal Bracing of the Tower; Very High-strength Concrete of 59 Mega Pascal; and Tuned-Liquid 
              Damper to suppress building vibration. <br>
            </p>
          </div>
        </div>
      </section>


      <section class="bg-slide">
        <h2 class="sub-title">Our Outstanding Experiences</h2>
        <div class="wrap">
          <div class="card">
            <p class="text-content">
              &nbsp; &nbsp; <b>In 1991</b> – The Elephant Tower, our head office building, was designed and constructed to 
              stand as a landmark gateway of Bangkok. The three 32-story buildings are connected with 7-story 
              Vierendeel Trusses, spanning 32 meters between each tower. <br>
              &nbsp; &nbsp; <b>In 1996</b> – Thailand’s largest stadium “Rajamangala National Stadium” was designed and 
              constructed to possess a capacity of 65,000 seats. <br>
              &nbsp; &nbsp; <b>In 1999</b> – We provided both design and construction supervision consulting services to an 
              international building project “Bashundhara Shopping Complex in Dhaka, Bangladesh”, which was 
              known to be the biggest shopping and office complex in South Asia region. The project has the total 
              floor area of 160,000 square meters. <br>
              &nbsp; &nbsp; <b>From 1997 to 2003</b> – We was a part of the CSC-1 Consortium, responsible for construction 
              supervision of 20-kilometer long “MRTA” Project, the first subway in Thailand.
            </p>
          </div>
        </div>
      </section>


      <section class="bg-slide">
        <h2 class="sub-title">Our Outstanding Experiences</h2>
        <div class="wrap">
          <div class="card">
            <p class="text-content">
              &nbsp; &nbsp; Another proud project of “Arun Chaiseri Consulting Engineers” is “Queen Sirikit National 
              Convention Center”, which was the biggest national convention center for international convention 
              and exhibition. The design and construction for the project of 65,000 square meters was completed 
              within the period of only 16 months. <br>
              &nbsp; &nbsp; Moreover, “Arun Chaiseri Consulting Engineers” has been concerning about the society and 
              environment impact by providing consulting services for energy audition and recommendations for 
              energy conservation procedures to more than 500 government and private buildings, which include 
              hospitals, office buildings, residences, retail malls, department stores, industrial factories.
            </p>
          </div>
        </div>
      </section>


      <section class="bg-slide">
        <h2 class="sub-title">Our Outstanding Experiences</h2>
        <div class="wrap">
          <div class="card">
            <p class="text-content">
              &nbsp; &nbsp; <b>In 2002</b>, we were Project Management Consultant Consortium for the Six Investment Projects 
              of Thai Airways International Public Company Limited at Suvarnabhumi Airport. The project, costing 
              around 13,000 Million Baht, involves the management of design and construction activities of six 
              business categories of Thai Airways, including the Aircraft Maintenance Center; Ground Support 
              Equipment; Catering Facilities ; Operations Center ; Cargo & Mail Commercial Service ; and Ground 
              Customer Services. <br>
              &nbsp; &nbsp; Till now, our principles, that have long been practiced in all of our projects, are Strong, 
              Aesthetic, Functional, and Economical or simply SAFE, so that our clients receive what they deserve, 
              the Superb Quality. <br>
              &nbsp; &nbsp; From the strong intention and tremendous experience of Professor Arun Chaiseri to the 
              industrious and well educated team work, Arun Chaiseri Consulting Engineers Company Limited 
              would keep its service at high standard to meet engineering achievement and client’s utmost 
              satisfaction. <br>
            </p>
          </div>
        </div>
      </section>


      <section>
        <span class="background" style="background-image:url('https://img.freepik.com/free-photo/group-construction-workers-looking-plans-documents-sunlight_181624-61665.jpg?w=1060&t=st=1669883808~exp=1669884408~hmac=bf6ed7dd8d4cfe8e46effd119df4ab3635cb365534bc80e3b1a6f533e092cb23')"></span>
        <h2 class="title-second">Our Project Management & Construction Supervision Projects</h2>
      </section>


      <?php
          $template_id = $_GET['template_id'];
          $templateObj = new Template();

          $templateOnly = $templateObj->getTemplateOnly($template_id);
          $templates = $templateObj->getTemplateById($template_id);
          $countTemplate = count($templates);
      ?>  
      
      
      <!-- Slide from DB -->
      <section class="bg-template">
        <div class="solid-box">
              <h2 class="template-txt"><?=$templateOnly[0]['template_name']?></h2> 
        </div>
        <img src="./assets/img/acs/acs-logo.png" alt="ACSLogo" class="logo-tm">
      </section>

      <?php
        if($countTemplate > 0) { ?>
          <?php 
            for($i=0; $i< $countTemplate; $i++) {
              $decode_image = json_decode($templates[$i]['project_image']);
              $templates[$i]['project_image'] = $decode_image;
            }

            foreach($templates as $template) { ?>
            <section class="tm">
              <div class="tm-box">
                <div class="tm-row">
                  <div class="tm-column">
                    <img src="./uploads/project-images/<?= $template['project_image'][0] ?>" alt="ProjectImage" class="project-img">
                  </div>      
                  <div class="tm-column2">
                    <div>
                      <?php
                        if($templateOnly[0]['template_language'] == 'EN') { ?>
                          <h1><b><?=$template['project_name_en']?></b></h1>
                          <p class="text-content">
                            <b>Project Owner :</b> 
                            <?=$template['owner_name_en']?> <br>

                            <b>Project Location :</b> 
                            <?=$template['project_location_en']?> <br>

                            <b>Project Description :</b> 
                            <?=$template['project_description_en']?> <br>

                            <b>Project Value (M. Baht)  :</b> 
                            <?= number_format($template['project_value'], 2)?> <br>

                            <b>Total Area (Sq.m.) : </b> 
                            <?= number_format($template['project_area'], 2)?> <br>
                          </p>
                        <?php } else { ?>
                          <h1><b><?=$template['project_name_th']?></b></h1>
                          <p class="text-content">
                            <b>เจ้าของโครงการ :</b> 
                            <?=$template['owner_name_th']?> <br>
                            <b>ที่ตั้งโครงการ :</b> 
                            <?=$template['project_location_th']?> <br>

                            <b>ลักษณะโครงการ :</b> 
                            <?=$template['project_description_th']?> <br>

                            <b>มูลค่าโครงการ (บาท)   :</b> 
                            <?= number_format($template['project_value'], 2)?> <br>

                            <b>พื้นที่รวม (ตารางเมตร) : </b> 
                            <?= number_format($template['project_area'], 2)?> <br>
                          </p>
                      <?php }
                      
                      ?>
                    </div>
                    <div class="hr"></div> 
                  </div>     
                </div>                
              </div>
              <img src="./assets/img/acs/acs-logo.png" alt="ACSLogo" class="logo-tm">
            </section>
        <?php }?>
      <?php }?>                

    </article>
  </main>

  <script src="./assets/static/js/webslides.js"></script>

  <script type="text/javascript">
    window.ws = new WebSlides();
  </script>

</body>

</html>


<?php }?>

