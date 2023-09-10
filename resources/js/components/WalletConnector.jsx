import React, { useEffect } from 'react';
import ReactDOM from 'react-dom/client';
import {
    reconnectProviders,
    useInitializeProviders,
    WalletProvider,
    PROVIDER_ID,
    useWallet
} from "@txnlab/use-wallet";
import Connect from "./Connect";
import { DeflyWalletConnect } from '@blockshake/defly-connect';
import { PeraWalletConnect } from '@perawallet/connect';
import { DaffiWalletConnect } from '@daffiwallet/connect';
import MyAlgoConnect from '@randlabs/myalgo-connect';
import { WalletConnectModalSign } from '@walletconnect/modal-sign-html';

const App = () => {
    const walletProviders = useInitializeProviders({
        providers: [
            { id: PROVIDER_ID.DEFLY, clientStatic: DeflyWalletConnect },
            { id: PROVIDER_ID.PERA, clientStatic: PeraWalletConnect },
            { id: PROVIDER_ID.DAFFI, clientStatic: DaffiWalletConnect },
            { id: PROVIDER_ID.MYALGO, clientStatic: MyAlgoConnect },
            {
                id: PROVIDER_ID.WALLETCONNECT,
                clientStatic: WalletConnectModalSign,
                clientOptions: {
                    projectId: '74761852c2f607c540bb116a1bc9f011',
                    metadata: {
                        name: 'Example Dapp',
                        description: 'Example Dapp',
                        url: '#',
                        icons: ['https://walletconnect.com/walletconnect-logo.png']
                    }
                }
            }
        ]
    });

    useEffect(() => {
        if (walletProviders !== null) {
            reconnectProviders(walletProviders).then(r => {});
        }
    }, [walletProviders]);

    return (
        <div>
            <WalletProvider value={walletProviders}>
                <Connect />
            </WalletProvider>
        </div>
    );
};

if (document.getElementById('wallet-connector')) {
    const Index = ReactDOM.createRoot(document.getElementById("wallet-connector"));
    Index.render(<App />);
}
