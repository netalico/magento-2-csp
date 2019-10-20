# Easy Magento 2 Content Security Policy (CSP) Enforcement

1. Go to https://report-uri.com/register and register for a free account.
2. Go to CSP->Wizard.
3. Click "Create your Wizard reporting address."
4. Copy your current subdomain.
5. Install the Magento module.
6. Go to Stores->Configuration->Netalico->CSP.
7. Enable the extension, paste the subdomain in the Report URI Subdomain field, and a part of your checkout URL (e.g. "onepage") and hit save.
8. Clear your Magento cache and browse around the frontend of your website. Make sure you go to an example of every type of page, including the cart and the checkout.
9. On https://report-uri.com Go back to CSP->Wizard and click allow on everything you recognize. If you see any suspcicious scripts, you should investigate and verify that they're legitimate.
10. Click on CSP-My Policies and copy the policy text to Magento in Stores->Configuration->Netalico->CSP->Policy.
11. For maximum security, go back to Magento and Stores->Configuration->Netalico->CSP change the Reporting Mode to enforce. 12. Alternatively, you can set the Reporting Mode to Reporting Only (but if you do that on your live site, you'll probably surpass the free limit of Report-Uri.com).
13. I recommend you at least enable Checkout Lockdown which enforces your CSP on the checkout, which is the most vulnerable part of the site for js infections.
